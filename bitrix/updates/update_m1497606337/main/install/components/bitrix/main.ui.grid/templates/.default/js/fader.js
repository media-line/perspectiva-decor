;(function() {
	'use strict';

	BX.namespace('BX.Grid');


	/**
	 * BX.Grid.Fader
	 * @param {BX.Main.grid} parent
	 * @constructor
	 */
	BX.Grid.Fader = function(parent)
	{
		this.parent = null;
		this.table = null;
		this.container = null;
		this.init(parent);
	};

	BX.Grid.Fader.prototype = {
		init: function(parent)
		{
			this.parent = parent;
			this.table = this.parent.getTable();
			this.container = this.table.parentNode;

			if (this.parent.getParam('ALLOW_PIN_HEADER'))
			{
				this.fixedTable = this.parent.getPinHeader().getFixedTable();
			}

			BX.bind(window, 'resize', BX.delegate(this.toggle, this));
			BX.bind(window, 'scroll', BX.debounce(this._onWindowScroll, 400, this));
			BX.bind(this.container, 'scroll', BX.delegate(this.toggle, this));
			BX.addCustomEvent(window, 'Grid::updated', BX.delegate(this.toggle, this));
			BX.addCustomEvent(window, 'Grid::columnResize', BX.delegate(this.toggle, this));
			BX.bind(this.getEarLeft(), 'mouseenter', BX.delegate(this._onMouseoverLeft, this));
			BX.bind(this.getEarRight(), 'mouseenter', BX.delegate(this._onMouseoverRight, this));
			BX.bind(this.getEarLeft(), 'mouseleave', BX.delegate(this._onMouseleaveLeft, this));
			BX.bind(this.getEarRight(), 'mouseleave', BX.delegate(this._onMouseleaveRight, this));

			this.toggle();
			this.adjustEarOffset(true);
		},

		_onMouseoverLeft: function()
		{
			var offset = this.container.scrollLeft;

			this.leftTimer = setTimeout(BX.proxy(function() {
				this.leftInterval = setInterval(BX.delegate(function() {
					offset -= 8;
					BX.Grid.Utils.requestAnimationFrame(BX.proxy(function() {
						this.container.scrollLeft = offset;
					}, this));
				}, this), (1000/60)/2);
			}, this), 100);
		},

		_onMouseoverRight: function()
		{
			var offset = this.container.scrollLeft;
			this.rightTimer = setTimeout(BX.proxy(function() {
				this.rightInterval = setInterval(BX.delegate(function() {
					offset += 8;
					BX.Grid.Utils.requestAnimationFrame(BX.proxy(function() {
						this.container.scrollLeft = offset;
					}, this));
				}, this), (1000/60)/2);
			}, this), 100);
		},

		_onMouseleaveLeft: function()
		{
			clearTimeout(this.leftTimer);
			clearInterval(this.leftInterval);
		},

		_onMouseleaveRight: function()
		{
			clearTimeout(this.rightTimer);
			clearInterval(this.rightInterval);
		},

		getEarLeft: function()
		{
			if (!this.earLeft)
			{
				this.earLeft = BX.Grid.Utils.getByClass(this.parent.getContainer(), this.parent.settings.get('classEarLeft'), true);
			}

			return this.earLeft;
		},

		getEarRight: function()
		{
			if (!this.earRight)
			{
				this.earRight = BX.Grid.Utils.getByClass(this.parent.getContainer(), this.parent.settings.get('classEarRight'), true);
			}

			return this.earRight;
		},

		adjustEarOffset: function(prepare)
		{
			if (prepare)
			{
				this.windowHeight = BX.height(window);
				this.tbodyPos = BX.pos(this.table.tBodies[0]);
				this.headerPos = BX.pos(this.table.tHead);
			}

			var bottomPos = (window.scrollY + this.windowHeight) - this.tbodyPos.top;
			var posTop = window.scrollY - this.tbodyPos.top;

			if (bottomPos > (this.tbodyPos.bottom - this.tbodyPos.top))
			{
				bottomPos = this.tbodyPos.bottom - this.tbodyPos.top;
			}

			if (posTop < this.headerPos.height)
			{
				posTop = this.headerPos.height;
			}
			else
			{

				bottomPos -= posTop;
				bottomPos += this.headerPos.height;
			}

			BX.Grid.Utils.requestAnimationFrame(BX.proxy(function() {
				if (posTop !== this.lastPosTop)
				{
					this.getEarLeft().style.transform = 'translate3d(0px, ' + posTop + 'px, 0)';
					this.getEarRight().style.transform = 'translate3d(0px, ' + posTop + 'px, 0)';
				}

				if (bottomPos !== this.lastBottomPos)
				{
					this.getEarLeft().style.height = bottomPos + 'px';
					this.getEarRight().style.height = bottomPos + 'px';
				}

				this.lastPosTop = posTop;
				this.lastBottomPos = bottomPos;
			}, this));
		},

		_onWindowScroll: function()
		{
			this.adjustEarOffset();
		},

		toggle: function()
		{
			this.adjustEarOffset(true);

			if (this.fixedTable)
			{
				BX.Grid.Utils.requestAnimationFrame(BX.proxy(function() {
					this.fixedTable.style.transform = 'translate3d(-'+this.container.scrollLeft+'px, 0px, 0)';
				}, this));
			}

			if (this.table.offsetWidth > this.container.clientWidth)
			{
				if (this.container.scrollLeft > 0)
				{
					BX.addClass(
						this.container.parentNode,
						this.parent.settings.get('classFadeContainerLeft')
					);

					BX.addClass(this.getEarLeft(), this.parent.settings.get('classShow'));
				}
				else
				{
					BX.removeClass(
						this.container.parentNode,
						this.parent.settings.get('classFadeContainerLeft')
					);

					BX.removeClass(this.getEarLeft(), this.parent.settings.get('classShow'));
				}

				if (this.table.offsetWidth > (this.container.scrollLeft + this.container.clientWidth))
				{
					BX.addClass(
						this.container.parentNode,
						this.parent.settings.get('classFadeContainerRight')
					);

					BX.addClass(this.getEarRight(), this.parent.settings.get('classShow'));
				}
				else
				{
					BX.removeClass(
						this.container.parentNode,
						this.parent.settings.get('classFadeContainerRight')
					);

					BX.removeClass(this.getEarRight(), this.parent.settings.get('classShow'));
				}
			}
			else
			{
				BX.removeClass(
					this.container.parentNode,
					this.parent.settings.get('classFadeContainerLeft')
				);
				BX.removeClass(
					this.container.parentNode,
					this.parent.settings.get('classFadeContainerRight')
				);

				BX.removeClass(this.getEarLeft(), this.parent.settings.get('classShow'));
				BX.removeClass(this.getEarRight(), this.parent.settings.get('classShow'));
			}
		}
	};
})();