console.log("fdsfd");

// if (typeof(BX.CrmQuickPanelEdit) === 'undefined')
//     {
//         BX.CrmQuickPanelEdit = function(id)
//         {
//             this._id = id;
//             this._settings = {};
//             this._submitHandler = BX.delegate(this._clickHandler, this);
//             BX.bind(BX(this._id + '_submit'), 'click', this._submitHandler);
//         };
//         BX.CrmQuickPanelEdit.prototype =
//         {
//             initialize: function(id, settings)
//             {
//                 this._id = id;
//                 this._settings = settings;
//             },
//             getId: function()
//             {
//                 return this._id;
//             },
//             _clickHandler: function(e)
//             {
//                 console.log(e);
//             }
//         };
//         BX.CrmQuickPanelEdit.create = function(id, settings)
//         {
//             var _self = new BX.CrmQuickPanelEdit(id);
//             _self.initialize(id, settings);
//             return _self;
//         };
//     }