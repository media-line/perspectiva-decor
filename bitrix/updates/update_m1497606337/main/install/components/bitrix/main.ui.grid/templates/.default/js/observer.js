;(function() {
	'use strict';

	BX.namespace('BX.Grid');

	BX.Grid.observer = {
		handlers: [],
		add: function(node, event, handler, context)
		{
			if (!this.get({node: node, event: event, handler: handler}).length)
			{
				this.handlers.push({
					node: node,
					event: event,
					handler: handler,
					context: context
				});

				BX.bind(
					node,
					event,
					context ? BX.delegate(handler, context) : handler
				);
			}
		},

		get: function(filter)
		{
			var result = this.handlers;
			var keys;

			if (BX.type.isPlainObject(filter) && (BX.type.isArray(this.handlers) && this.handlers.length))
			{
				keys = Object.keys(filter);

				result = this.handlers.filter(function(current) {
					return keys.filter(function(filterKey) {
							return current[filterKey] === filter[filterKey];
						}).length === keys.length;
				});
			}

			return result;
		}
	};
})();