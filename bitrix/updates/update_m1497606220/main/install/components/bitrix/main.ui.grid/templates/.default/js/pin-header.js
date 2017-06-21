;(function() {
	'use strict';

	BX.namespace('BX.Grid');


	/**
	 * BX.Grid.PinHeader
	 * @param {BX.Main.grid} parent
	 * @constructor
	 */
	BX.Grid.PinHeader = function(parent)
	{
		this.parent = null;
		this.fixedTable = null;
		this.header = null;
		this.init(parent);
	};

	BX.Grid.PinHeader.prototype = {
		init: function(parent)
		{
			this.parent = parent;
			this.fixedTable = this.getFixedTable();
			this.header = this.getHeader();
			this.headerTop = BX.pos(this.header).top;

			BX.bind(window, 'resize', BX.delegate(this.adjustFixedTablePosition, this));

			this.bindOnScroll();
		},

		bindOnScroll: function()
		{
			BX.bind(window, 'scroll', BX.delegate(this._onScroll, this));
		},

		getFixedTable: function()
		{
			var container;

			if (!this.fixedTable)
			{
				container = BX.create('div', {
					props: {className: 'main-grid-fixed-bar main-grid-fixed-top'}
				});

				this.fixedTable = BX.create('table', {props: {className: 'main-grid-table'}});
				container.appendChild(this.fixedTable);
				this.parent.getScrollContainer().parentNode.appendChild(container);
			}

			return this.fixedTable;
		},

		checkHeaderPosition: function()
		{
			return this.headerTop <= window.scrollY;
		},

		getHeader: function()
		{
			this.header = this.header || this.parent.getHead();
			return this.header;
		},

		pinHeader: function()
		{
			if (!this.isPinned())
			{
				var fixedTable = this.getFixedTable();
				var cells = this.parent.getRows().getHeadFirstChild().getCells();
				var cellsKeys = Object.keys(cells);

				cellsKeys.forEach(function(key) {
					var cellContainer = BX.firstChild(cells[key]);
					if (cellContainer)
					{
						var cellRect = cells[key].getBoundingClientRect();
						cellContainer.style.width = cellRect.width + 'px';
					}
				});

				var clone = BX.clone(this.header);
				fixedTable.appendChild(clone);
				var tableRect = fixedTable.parentNode.parentNode.getBoundingClientRect();
				fixedTable.parentNode.style.width = tableRect.width + 'px';
				BX.onCustomEvent(window, 'Grid::headerPinned', []);
			}
		},

		unpinHeader: function()
		{
			if (this.isPinned())
			{
				BX.html(this.getFixedTable(), '');
				BX.onCustomEvent(window, 'Grid::headerUnpinned', []);
			}
		},

		isPinned: function()
		{
			return this.getFixedTable().children.length;
		},

		adjustFixedTablePosition: function()
		{
			if (this.getFixedTable())
			{
				var containerRect = this.parent.getContainer().getBoundingClientRect();
				var leftPos = containerRect.left;
				var containerWidth = containerRect.width;

				if (leftPos !== this.lastLeftPos)
				{
					this.getFixedTable().parentNode.style.left = leftPos + 'px';
				}

				if (containerWidth !== this.lastContainerWidth)
				{
					this.getFixedTable().parentNode.style.width = containerWidth + 'px';
				}

				this.lastLeftPos = leftPos;
				this.lastContainerWidth = containerWidth;
			}
		},

		_onScroll: function()
		{
			this.adjustFixedTablePosition();

			if (this.checkHeaderPosition())
			{
				this.pinHeader();
			}
			else
			{
				this.unpinHeader();
			}
		}
	};

})();