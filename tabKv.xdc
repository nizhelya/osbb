{
    "xdsVersion": "3.2.0",
    "frameworkVersion": "ext51",
    "internals": {
        "type": "Ext.panel.Panel",
        "reference": {
            "name": "items",
            "type": "array"
        },
        "codeClass": null,
        "userConfig": {
            "bodyBorder": false,
            "closable": true,
            "designer|userAlias": "tabkvartplata",
            "designer|userClassName": "sprav.TabKvartplata",
            "id": "tabKvartplata",
            "layout": "fit",
            "maxWidth": 900,
            "minWidth": null,
            "scrollable": true,
            "title": "Квартплата",
            "width": 890
        },
        "configAlternates": {
            "scrollable": "boolean"
        },
        "cn": [
            {
                "type": "Ext.form.Panel",
                "reference": {
                    "name": "items",
                    "type": "array"
                },
                "codeClass": null,
                "userConfig": {
                    "bodyPadding": null,
                    "height": null,
                    "id": "fmKvartplata",
                    "scrollable": true,
                    "title": "",
                    "width": null
                },
                "name": "MyForm35",
                "configAlternates": {
                    "scrollable": "boolean"
                },
                "cn": [
                    {
                        "type": "Ext.grid.Panel",
                        "reference": {
                            "name": "items",
                            "type": "array"
                        },
                        "codeClass": null,
                        "userConfig": {
                            "bodyBorder": true,
                            "bodyPadding": null,
                            "height": null,
                            "id": "grTarifHousesKv",
                            "layout|anchor": "100%",
                            "padding": 10,
                            "scrollable": true,
                            "store": "StTarif",
                            "title": "Дома",
                            "width": 925
                        },
                        "name": "MyGridPanel26",
                        "configAlternates": {
                            "scrollable": "boolean"
                        },
                        "cn": [
                            {
                                "type": "Ext.view.Table",
                                "reference": {
                                    "name": "viewConfig",
                                    "type": "object"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "frame": null,
                                    "height": null
                                },
                                "name": "MyGridView56",
                                "configAlternates": {
                                    "scrollable": "boolean"
                                }
                            },
                            {
                                "type": "Ext.toolbar.Toolbar",
                                "reference": {
                                    "name": "dockedItems",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "dock": "top",
                                    "frame": null
                                },
                                "name": "MyToolbar9",
                                "configAlternates": {
                                    "scrollable": "boolean"
                                },
                                "cn": [
                                    {
                                        "type": "Ext.form.field.ComboBox",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "designer|displayName": null,
                                            "displayField": "house",
                                            "fieldLabel": "Дом",
                                            "labelAlign": null,
                                            "labelWidth": 45,
                                            "layout|flex": null,
                                            "name": "house_id",
                                            "queryMode": "local",
                                            "store": "StHousesOrg",
                                            "valueField": "house_id",
                                            "width": 220
                                        },
                                        "name": "MyComboBox47",
                                        "configAlternates": {
                                            "scrollable": "boolean"
                                        },
                                        "cn": [
                                            {
                                                "type": "basiceventbinding",
                                                "reference": {
                                                    "name": "listeners",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "fn": "onComboboxSelect211",
                                                    "implHandler": [
                                                        "//in use",
                                                        "",
                                                        "//STORE",
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "var StTarif = Ext.data.StoreManager.get(\"StTarif\");",
                                                        "var tarif = Ext.getCmp('tarKv');",
                                                        "var viborTarif = Ext.getCmp('cbTarifKv');",
                                                        "var form = combo.findParentByType('form');",
                                                        "//var data = form.getForm().findField('data').getValue();",
                                                        "",
                                                        "//LOGIN & PASSWORD",
                                                        "",
                                                        "var values =stUser.getAt(0);",
                                                        "var login = values.get('login');",
                                                        "var password = values.get('password');",
                                                        "",
                                                        "//LOGIKA",
                                                        "if (record) {",
                                                        "    StTarif.load({",
                                                        "        params: {",
                                                        "            what:'TarifFromHouse',",
                                                        "            login:login,",
                                                        "            password:password,",
                                                        "            //data:data,",
                                                        "            house_id: record.get('house_id')",
                                                        "        },",
                                                        "        callback: function(records,operation,success){",
                                                        "            if(success){",
                                                        "                viborTarif.clearValue();",
                                                        "                viborTarif.setDisabled(true);",
                                                        "                tarif.setValue(0);",
                                                        "            }",
                                                        "        },",
                                                        "        scope:this",
                                                        "    });",
                                                        "}"
                                                    ],
                                                    "name": "select",
                                                    "scope": "me"
                                                },
                                                "name": "onComboboxSelect211"
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.form.field.ComboBox",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "disabled": null,
                                            "displayField": "usluga",
                                            "fieldLabel": "услуга",
                                            "id": "cbTarifKv",
                                            "labelAlign": null,
                                            "labelWidth": 50,
                                            "layout|flex": null,
                                            "name": "viborTarif",
                                            "queryMode": "local",
                                            "readOnly": null,
                                            "store": "StKvTarif",
                                            "valueField": "tarif",
                                            "width": 220
                                        },
                                        "name": "MyComboBox48",
                                        "configAlternates": {
                                            "scrollable": "boolean"
                                        },
                                        "cn": [
                                            {
                                                "type": "basiceventbinding",
                                                "reference": {
                                                    "name": "listeners",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "fn": "onCbTarifKvSelect",
                                                    "implHandler": [
                                                        "//in use",
                                                        "",
                                                        "//STORE",
                                                        "",
                                                        "var form = combo.findParentByType('form');",
                                                        "var tarif = form.getForm().findField('tar');",
                                                        "var grid = Ext.getCmp('grTarifHousesKv');",
                                                        "var btnInsTarif = Ext.getCmp('btnInsTarifKv');",
                                                        "var selected = record;",
                                                        "",
                                                        "if (record) {",
                                                        "    var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection()[0];",
                                                        "",
                                                        "    var size = Ext.Object.getSize(gridRowSelectedRecords) ;",
                                                        "    btnInsTarif.setDisabled(false);",
                                                        "",
                                                        "    tarif.setValue(gridRowSelectedRecords.get(record.get('tarif')));",
                                                        "",
                                                        "}",
                                                        ""
                                                    ],
                                                    "name": "select",
                                                    "scope": "me"
                                                },
                                                "name": "onCbTarifKvSelect"
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.form.field.Number",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "decimalPrecision": 3,
                                            "fieldLabel": "значение",
                                            "fieldStyle": "background-color:#F0F8FF;font-size:10pt;text-align:right;",
                                            "hideTrigger": true,
                                            "id": "tarKv",
                                            "labelWidth": 80,
                                            "layout|flex": null,
                                            "name": "tar",
                                            "step": null,
                                            "value": [
                                                "0"
                                            ],
                                            "width": 200
                                        },
                                        "name": "MyNumberField154",
                                        "configAlternates": {
                                            "scrollable": "boolean"
                                        }
                                    },
                                    {
                                        "type": "Ext.button.Button",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "arrowAlign": null,
                                            "disabled": true,
                                            "formBind": null,
                                            "icon": "resources/css/images/ico/yes.png",
                                            "iconAlign": null,
                                            "id": "btnInsTarifKv",
                                            "layout|flex": null,
                                            "text": "Записать ",
                                            "width": 135
                                        },
                                        "name": "MyButton140",
                                        "configAlternates": {
                                            "scrollable": "boolean"
                                        },
                                        "cn": [
                                            {
                                                "type": "fixedfunction",
                                                "reference": {
                                                    "name": "items",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "designer|params": [
                                                        "button",
                                                        "event"
                                                    ],
                                                    "fn": "handler",
                                                    "implHandler": [
                                                        "// in use",
                                                        "var value = button.findParentByType('form').getValues();",
                                                        "//STORE",
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "var StTarif = Ext.data.StoreManager.get(\"StTarif\");",
                                                        "",
                                                        "//LOGIN & PASSWORD",
                                                        "var tarif = Ext.getCmp('tarKv');",
                                                        "var viborTarif = Ext.getCmp('cbTarifKv');",
                                                        "",
                                                        "//LOGIKA",
                                                        "var grid = Ext.getCmp('grTarifHousesKv');",
                                                        "",
                                                        "var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();",
                                                        "var size = Ext.Object.getSize(gridRowSelectedRecords) ;",
                                                        "var values =stUser.getAt(0);",
                                                        "var login = values.get('login');",
                                                        "var password = values.get('password');",
                                                        "var params =[];",
                                                        "if (size >= 1){",
                                                        "    params = {",
                                                        "        login:values.get('login'),",
                                                        "        password:values.get('password'),",
                                                        "        what:\"vvod_tarif_kv\",",
                                                        "        name_tar:value.viborTarif,",
                                                        "        new_tar:value.tar",
                                                        "    };",
                                                        "",
                                                        "",
                                                        "",
                                                        "    Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {",
                                                        "        Ext.Object.merge(val.data, params);",
                                                        "        QueryAddress.updateRecords(val.data,function(results){",
                                                        "            if(results.res){",
                                                        "                return  true;",
                                                        "            }  else {",
                                                        "                return  false;",
                                                        "            }",
                                                        "        });",
                                                        "",
                                                        "    });",
                                                        "",
                                                        "    StTarif.load({",
                                                        "        params: {",
                                                        "            what:'TarifFromHouse',",
                                                        "            login:login,",
                                                        "            password:password,",
                                                        "            house_id: value.house_id",
                                                        "        },",
                                                        "        callback: function(records,operation,success){",
                                                        "            if(success){",
                                                        "                viborTarif.clearValue();",
                                                        "                viborTarif.setDisabled(true);",
                                                        "                button.setDisabled(true);",
                                                        "                tarif.setValue(0);",
                                                        "            }",
                                                        "        },",
                                                        "        scope:this",
                                                        "    });",
                                                        "",
                                                        "}"
                                                    ]
                                                },
                                                "name": "handler"
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                "type": "Ext.selection.CheckboxModel",
                                "reference": {
                                    "name": "selModel",
                                    "type": "object"
                                },
                                "codeClass": "Ext.selection.CheckboxModel",
                                "userConfig": {
                                    "mode": "SINGLE",
                                    "showHeaderCheckbox": true
                                },
                                "name": "MyCheckboxSelectionModel9"
                            },
                            {
                                "type": "Ext.grid.column.Number",
                                "reference": {
                                    "name": "columns",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "dataIndex": "raion",
                                    "hidden": true,
                                    "text": "Raion"
                                },
                                "name": "MyNumberColumn313",
                                "configAlternates": {
                                    "scrollable": "boolean"
                                }
                            },
                            {
                                "type": "Ext.grid.column.Column",
                                "reference": {
                                    "name": "columns",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "text": "Дом"
                                },
                                "name": "MyColumn1",
                                "cn": [
                                    {
                                        "type": "Ext.grid.column.Number",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "dataIndex": "house_id",
                                            "format": "0",
                                            "menuDisabled": true,
                                            "text": "ид",
                                            "width": 58
                                        },
                                        "name": "MyNumberColumn314",
                                        "configAlternates": {
                                            "scrollable": "boolean"
                                        }
                                    },
                                    {
                                        "type": "Ext.grid.column.Date",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "align": "center",
                                            "dataIndex": "data",
                                            "format": "F,y",
                                            "menuDisabled": true,
                                            "text": "дата",
                                            "width": 105
                                        },
                                        "name": "MyDateColumn"
                                    },
                                    {
                                        "type": "Ext.grid.column.Column",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "align": "center",
                                            "dataIndex": "house",
                                            "menuDisabled": true,
                                            "text": "Адрес",
                                            "width": 158
                                        },
                                        "name": "MyColumn266",
                                        "configAlternates": {
                                            "scrollable": "boolean"
                                        }
                                    },
                                    {
                                        "type": "Ext.grid.column.Number",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "dataIndex": "floor",
                                            "flex": null,
                                            "format": "0",
                                            "menuDisabled": true,
                                            "text": "Эт",
                                            "width": 58
                                        },
                                        "name": "MyNumberColumn315",
                                        "configAlternates": {
                                            "scrollable": "boolean"
                                        }
                                    }
                                ]
                            },
                            {
                                "type": "Ext.grid.column.Column",
                                "reference": {
                                    "name": "columns",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "text": "Тариф по квартплате "
                                },
                                "name": "MyColumn2",
                                "cn": [
                                    {
                                        "type": "Ext.grid.column.Column",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "text": "1-й этаж"
                                        },
                                        "name": "MyColumn3",
                                        "cn": [
                                            {
                                                "type": "Ext.grid.column.Number",
                                                "reference": {
                                                    "name": "columns",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "align": "center",
                                                    "dataIndex": "kvf1",
                                                    "format": "0.000",
                                                    "hidden": null,
                                                    "menuDisabled": true,
                                                    "text": "Тариф",
                                                    "width": 70
                                                },
                                                "name": "MyNumberColumn316",
                                                "configAlternates": {
                                                    "scrollable": "boolean"
                                                }
                                            },
                                            {
                                                "type": "Ext.grid.column.Number",
                                                "reference": {
                                                    "name": "columns",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "align": "center",
                                                    "dataIndex": "ch_kvf1",
                                                    "format": "0.000",
                                                    "hidden": null,
                                                    "menuDisabled": true,
                                                    "text": "Перер",
                                                    "width": 70
                                                },
                                                "name": "MyNumberColumn317",
                                                "configAlternates": {
                                                    "scrollable": "boolean"
                                                }
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.grid.column.Column",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "text": "2-й и выше"
                                        },
                                        "name": "MyColumn4",
                                        "cn": [
                                            {
                                                "type": "Ext.grid.column.Number",
                                                "reference": {
                                                    "name": "columns",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "align": "center",
                                                    "dataIndex": "kv",
                                                    "format": "0.000",
                                                    "hidden": null,
                                                    "menuDisabled": true,
                                                    "text": "Тариф",
                                                    "width": 70
                                                },
                                                "name": "MyNumberColumn",
                                                "configAlternates": {
                                                    "scrollable": "boolean"
                                                }
                                            },
                                            {
                                                "type": "Ext.grid.column.Number",
                                                "reference": {
                                                    "name": "columns",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "align": "center",
                                                    "dataIndex": "ch_kv",
                                                    "format": "0.000",
                                                    "hidden": null,
                                                    "menuDisabled": true,
                                                    "text": "Перер",
                                                    "width": 70
                                                },
                                                "name": "MyNumberColumn1",
                                                "configAlternates": {
                                                    "scrollable": "boolean"
                                                }
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                "type": "Ext.grid.column.Column",
                                "reference": {
                                    "name": "columns",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "text": "льготный тариф"
                                },
                                "name": "MyColumn5",
                                "cn": [
                                    {
                                        "type": "Ext.grid.column.Column",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "text": "1-этаж"
                                        },
                                        "name": "MyColumn6",
                                        "cn": [
                                            {
                                                "type": "Ext.grid.column.Number",
                                                "reference": {
                                                    "name": "columns",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "align": "center",
                                                    "dataIndex": "lgf1",
                                                    "format": "0.000",
                                                    "hidden": null,
                                                    "menuDisabled": true,
                                                    "text": "Тариф",
                                                    "width": 78
                                                },
                                                "name": "MyNumberColumn1",
                                                "configAlternates": {
                                                    "scrollable": "boolean"
                                                }
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.grid.column.Column",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "text": "2 и выше"
                                        },
                                        "name": "MyColumn7",
                                        "cn": [
                                            {
                                                "type": "Ext.grid.column.Number",
                                                "reference": {
                                                    "name": "columns",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "align": "center",
                                                    "dataIndex": "lg",
                                                    "format": "0.000",
                                                    "hidden": null,
                                                    "menuDisabled": true,
                                                    "text": "Тариф",
                                                    "width": 82
                                                },
                                                "name": "MyNumberColumn",
                                                "configAlternates": {
                                                    "scrollable": "boolean"
                                                }
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                "type": "Ext.panel.Tool",
                                "reference": {
                                    "name": "tools",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "type": "search"
                                },
                                "name": "MyTool",
                                "cn": [
                                    {
                                        "type": "fixedfunction",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "designer|params": [
                                                "owner",
                                                "tool",
                                                "event"
                                            ],
                                            "fn": "callback",
                                            "implHandler": [
                                                "//STORE",
                                                "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                "var StTarif = Ext.data.StoreManager.get(\"StTarif\");",
                                                "//LOGIN & PASSWORD",
                                                "var values =stUser.getAt(0);",
                                                "var login = values.get('login');",
                                                "var password = values.get('password');",
                                                "// FORM",
                                                "var tarif = Ext.getCmp('tarKv');",
                                                "var viborTarif = Ext.getCmp('cbTarifKv');",
                                                "var form = tool.findParentByType('form');",
                                                "var value = form.getValues();",
                                                "",
                                                "  StTarif.load({",
                                                "            params: {",
                                                "                what:'TarifFromHouseAll',",
                                                "                login:login,",
                                                "                password:password,",
                                                "                house_id: value.house_id",
                                                "            },",
                                                "            callback: function(records,operation,success){",
                                                "                if(success){",
                                                "                    viborTarif.clearValue();",
                                                "                    viborTarif.setDisabled(true);",
                                                "                    tarif.setValue(0);",
                                                "                }",
                                                "            },",
                                                "            scope:this",
                                                "        });",
                                                ""
                                            ]
                                        },
                                        "name": "callback"
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        "type": "Ext.panel.Panel",
                        "reference": {
                            "name": "items",
                            "type": "array"
                        },
                        "codeClass": null,
                        "userConfig": {
                            "animCollapse": true,
                            "collapsed": null,
                            "collapsible": null,
                            "height": 297,
                            "layout": "fit",
                            "layout|anchor": "100%",
                            "padding": 10,
                            "title": "Начисление и перерасчет по электроэнергии",
                            "titleCollapse": true
                        },
                        "name": "MyPanel7",
                        "cn": [
                            {
                                "type": "Ext.form.FieldSet",
                                "reference": {
                                    "name": "items",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "designer|snapToGrid": 5,
                                    "height": 262,
                                    "layout": "absolute",
                                    "margin": null,
                                    "padding": "",
                                    "style": "background-color: #C2D9C9;",
                                    "title": "",
                                    "width": 908
                                },
                                "name": "MyFieldSet30",
                                "configAlternates": {
                                    "style": "string",
                                    "scrollable": "boolean"
                                },
                                "cn": [
                                    {
                                        "type": "Ext.form.field.Checkbox",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "boxLabel": "",
                                            "checked": null,
                                            "fieldLabel": "тарифы установлены вручную",
                                            "inputValue": "1",
                                            "labelWidth": 230,
                                            "layout|x": 10,
                                            "layout|y": 60,
                                            "name": "tarif_manual",
                                            "style": "background-color: #C2D9E9;",
                                            "uncheckedValue": "0"
                                        },
                                        "name": "MyCheckbox80",
                                        "configAlternates": {
                                            "style": "string",
                                            "scrollable": "boolean"
                                        }
                                    },
                                    {
                                        "type": "Ext.form.field.TextArea",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "fieldLabel": "Инфо перер",
                                            "height": null,
                                            "layout|x": 15,
                                            "layout|y": 145,
                                            "name": "info",
                                            "style": "background-color: #C2D9E9;",
                                            "width": 465
                                        },
                                        "name": "MyTextArea",
                                        "configAlternates": {
                                            "style": "string",
                                            "scrollable": "boolean"
                                        }
                                    },
                                    {
                                        "type": "Ext.form.field.Number",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "decimalPrecision": 3,
                                            "fieldLabel": "действ",
                                            "hideTrigger": true,
                                            "labelWidth": 50,
                                            "layout|x": 15,
                                            "layout|y": 100,
                                            "name": "kv",
                                            "style": "background-color: #C2D9E9;",
                                            "width": 130
                                        },
                                        "name": "MyNumberField221",
                                        "configAlternates": {
                                            "style": "string",
                                            "scrollable": "boolean"
                                        }
                                    },
                                    {
                                        "type": "Ext.form.field.Number",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "decimalPrecision": 3,
                                            "fieldLabel": "новый",
                                            "hideTrigger": true,
                                            "labelWidth": 50,
                                            "layout|x": 150,
                                            "layout|y": 100,
                                            "name": "ch_kv",
                                            "style": "background-color: #C2D9E9;",
                                            "width": 130
                                        },
                                        "name": "MyNumberField222",
                                        "configAlternates": {
                                            "style": "string",
                                            "scrollable": "boolean"
                                        }
                                    },
                                    {
                                        "type": "Ext.form.FieldSet",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "height": 85,
                                            "layout|anchor": null,
                                            "layout|x": 290,
                                            "layout|y": 50,
                                            "style": "background-color: #C2D9E9;",
                                            "title": "Период перерасчета",
                                            "width": 190
                                        },
                                        "name": "MyFieldSet159",
                                        "configAlternates": {
                                            "style": "string",
                                            "scrollable": "boolean"
                                        },
                                        "cn": [
                                            {
                                                "type": "Ext.form.field.Date",
                                                "reference": {
                                                    "name": "items",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "fieldLabel": "Дата с",
                                                    "format": "d-m-Y",
                                                    "labelWidth": 60,
                                                    "layout|anchor": "100%",
                                                    "name": "sdata",
                                                    "submitFormat": "Ymd",
                                                    "width": 185
                                                },
                                                "name": "MyDateField65",
                                                "configAlternates": {
                                                    "scrollable": "boolean"
                                                }
                                            },
                                            {
                                                "type": "Ext.form.field.Date",
                                                "reference": {
                                                    "name": "items",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "fieldLabel": "Дата по",
                                                    "format": "d-m-Y",
                                                    "labelWidth": 60,
                                                    "layout|anchor": "100%",
                                                    "name": "fdata",
                                                    "submitFormat": "Ymd",
                                                    "width": 185
                                                },
                                                "name": "MyDateField66",
                                                "configAlternates": {
                                                    "scrollable": "boolean"
                                                }
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.form.field.Checkbox",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "boxLabel": "",
                                            "checked": true,
                                            "fieldLabel": "По всем квартирам дома",
                                            "inputValue": "1",
                                            "labelWidth": 200,
                                            "layout|x": 490,
                                            "layout|y": 60,
                                            "name": "allkv",
                                            "style": "background-color: #C2D9E9;",
                                            "uncheckedValue": "0"
                                        },
                                        "name": "MyCheckbox79",
                                        "configAlternates": {
                                            "style": "string",
                                            "scrollable": "boolean"
                                        },
                                        "cn": [
                                            {
                                                "type": "fixedfunction",
                                                "reference": {
                                                    "name": "items",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "designer|params": [
                                                        "checkbox",
                                                        "checked"
                                                    ],
                                                    "fn": "handler",
                                                    "implHandler": [
                                                        "var form = checkbox.findParentByType('form');",
                                                        "var  address_ot = form.getForm().findField('address_ot');",
                                                        "var  address_do = form.getForm().findField('address_do');",
                                                        "",
                                                        "if(checked===true){",
                                                        "    if (address_ot.isVisible()) address_ot.hide();",
                                                        "    if (address_do.isVisible()) address_do.hide();",
                                                        "} else {",
                                                        "    if (address_ot.isHidden()) address_ot.show();",
                                                        "    if (address_do.isHidden()) address_do.show();",
                                                        "",
                                                        "}"
                                                    ]
                                                },
                                                "name": "handler"
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.form.field.ComboBox",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "disabled": null,
                                            "displayField": "address",
                                            "enableKeyEvents": true,
                                            "fieldLabel": "c",
                                            "forceSelection": true,
                                            "hidden": true,
                                            "labelWidth": 20,
                                            "layout|anchor": null,
                                            "layout|x": 530,
                                            "layout|y": 90,
                                            "name": "address_ot",
                                            "queryMode": "local",
                                            "store": "StAddressOrg",
                                            "style": "background-color: #C2D9E9;",
                                            "valueField": "address_id",
                                            "width": 185
                                        },
                                        "name": "MyComboBox45",
                                        "configAlternates": {
                                            "scrollable": "boolean",
                                            "style": "string"
                                        }
                                    },
                                    {
                                        "type": "Ext.form.field.ComboBox",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "disabled": null,
                                            "displayField": "address",
                                            "editable": false,
                                            "fieldLabel": "по",
                                            "forceSelection": true,
                                            "hidden": true,
                                            "labelWidth": 20,
                                            "layout|anchor": null,
                                            "layout|x": 530,
                                            "layout|y": 120,
                                            "name": "address_do",
                                            "queryMode": "local",
                                            "store": "StAddressOrg",
                                            "style": "background-color: #C2D9E9;",
                                            "valueField": "address_id",
                                            "width": 185
                                        },
                                        "name": "MyComboBox46",
                                        "configAlternates": {
                                            "scrollable": "boolean",
                                            "style": "string"
                                        }
                                    },
                                    {
                                        "type": "Ext.button.Button",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "disabled": true,
                                            "formBind": null,
                                            "height": null,
                                            "icon": "resources/css/images/ico/add.png",
                                            "id": "btAddPererKv",
                                            "itemId": null,
                                            "layout|x": 490,
                                            "layout|y": 165,
                                            "style": null,
                                            "text": "Перерасчитать квартплату за период",
                                            "width": 295
                                        },
                                        "name": "MyButton139",
                                        "configAlternates": {
                                            "scrollable": "boolean",
                                            "style": "string"
                                        }
                                    },
                                    {
                                        "type": "Ext.form.field.Date",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "fieldLabel": "Период начисления",
                                            "format": "F,Y",
                                            "id": null,
                                            "labelWidth": 130,
                                            "layout|x": 10,
                                            "layout|y": 15,
                                            "name": "data_nach",
                                            "readOnly": true,
                                            "startDay": 1,
                                            "style": "background-color: #C2D9C9;",
                                            "submitFormat": "Ymd",
                                            "width": 267
                                        },
                                        "name": "MyDateField52",
                                        "configAlternates": {
                                            "style": "string",
                                            "scrollable": "boolean"
                                        }
                                    },
                                    {
                                        "type": "Ext.button.Button",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "disabled": true,
                                            "formBind": false,
                                            "height": null,
                                            "icon": "resources/css/images/ico/add.png",
                                            "id": "btAddNachKv",
                                            "itemId": null,
                                            "layout|x": 290,
                                            "layout|y": 15,
                                            "text": "начислить квартплату за период",
                                            "width": 490
                                        },
                                        "name": "MyButton138",
                                        "configAlternates": {
                                            "scrollable": "boolean"
                                        }
                                    },
                                    {
                                        "type": "Ext.button.Button",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "arrowAlign": null,
                                            "disabled": true,
                                            "formBind": null,
                                            "height": null,
                                            "icon": "resources/css/images/ico/no.png",
                                            "iconAlign": "bottom",
                                            "id": "btnClearNachKv",
                                            "layout|x": 785,
                                            "layout|y": 15,
                                            "text": "",
                                            "tooltip": "Сброс признака <br>Квартплата  начислена",
                                            "width": null
                                        },
                                        "name": "MyButton143",
                                        "configAlternates": {
                                            "tooltip": "string",
                                            "scrollable": "boolean"
                                        },
                                        "cn": [
                                            {
                                                "type": "fixedfunction",
                                                "reference": {
                                                    "name": "items",
                                                    "type": "array"
                                                },
                                                "codeClass": null,
                                                "userConfig": {
                                                    "designer|params": [
                                                        "button",
                                                        "event"
                                                    ],
                                                    "fn": "handler",
                                                    "implHandler": [
                                                        "//STORE",
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "",
                                                        "var values =stUser.getAt(0);",
                                                        "var login = values.get('login');",
                                                        "var password = values.get('password');",
                                                        "",
                                                        "params = {",
                                                        "    login:values.get('login'),",
                                                        "    password:values.get('password'),",
                                                        "    what:\"clear_pr_kv\"",
                                                        "",
                                                        "};",
                                                        "QueryAddress.updateRecords(params,function(results){",
                                                        "    if(results.res){",
                                                        "        Ext.MessageBox.show({",
                                                        "            title: 'Сброс защиты ',",
                                                        "            msg: 'Можно начислять квартплату',",
                                                        "            buttons: Ext.MessageBox.OK,",
                                                        "            icon: Ext.MessageBox.INFO",
                                                        "        });",
                                                        "",
                                                        "    }",
                                                        "});",
                                                        "",
                                                        "",
                                                        ""
                                                    ]
                                                },
                                                "name": "handler"
                                            }
                                        ]
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        ]
    },
    "linkedNodes": {},
    "boundStores": {
        "175c67e8-6b5e-403a-9674-896a9ec1decf": {
            "type": "directstore",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "autoLoad": null,
                "designer|userAlias": "stTarif",
                "designer|userClassName": "StTarif",
                "model": "MdTarif",
                "storeId": "stTarif"
            },
            "cn": [
                {
                    "type": "Ext.data.proxy.Direct",
                    "reference": {
                        "name": "proxy",
                        "type": "object"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "directFn": "QueryLoad.getResults",
                        "extraParams": [
                            "{what:\"Tarif\"}"
                        ]
                    },
                    "name": "MyDirectProxy47",
                    "cn": [
                        {
                            "type": "Ext.data.reader.Json",
                            "reference": {
                                "name": "reader",
                                "type": "object"
                            },
                            "codeClass": null,
                            "userConfig": {
                                "rootProperty": "data"
                            },
                            "name": "MyJsonReader49"
                        }
                    ]
                }
            ]
        },
        "06aecb31-1516-4cd6-8d3e-4b8317a2d253": {
            "type": "directstore",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "autoLoad": null,
                "designer|userAlias": "StHousesOrg",
                "designer|userClassName": "StHousesOrg",
                "model": "MdHouses",
                "storeId": "StHousesOrg"
            },
            "cn": [
                {
                    "type": "Ext.data.proxy.Direct",
                    "reference": {
                        "name": "proxy",
                        "type": "object"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "directFn": "QueryLoad.getResults",
                        "extraParams": [
                            "{'what':'house'}"
                        ]
                    },
                    "name": "MyDirectProxy21",
                    "cn": [
                        {
                            "type": "Ext.data.reader.Json",
                            "reference": {
                                "name": "reader",
                                "type": "object"
                            },
                            "codeClass": null,
                            "userConfig": {
                                "rootProperty": "data"
                            },
                            "name": "MyJsonReader21"
                        }
                    ]
                }
            ]
        },
        "13bbf0b0-6e72-4cb5-8632-8b0608ff5367": {
            "type": "arraystore",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "autoLoad": true,
                "data": [
                    "[",
                    "{",
                    "\"usluga\": \"тариф 1-й этаж\",",
                    "\"tarif\": \"kvf1\"",
                    "},",
                    "{",
                    "\"usluga\": \"тариф 2-й и выше\",",
                    "\"tarif\": \"kv\"",
                    "},",
                    "{",
                    "\"usluga\": \"перер 1-й этаж\",",
                    "\"tarif\": \"ch_kvf1\"",
                    "},",
                    "{",
                    "\"usluga\": \"перер 2-й и выше\",",
                    "\"tarif\": \"ch_kv\"",
                    "},",
                    "{",
                    "\"usluga\": \" льготный 1-й этаж\",",
                    "\"tarif\": \"lgf1\"",
                    "},",
                    "{",
                    "\"usluga\": \"льготный 2-й и выше\",",
                    "\"tarif\": \"lg\"",
                    "}",
                    "]"
                ],
                "designer|userAlias": "stKvTarif",
                "designer|userClassName": "StKvTarif",
                "storeId": "stKvTarif"
            },
            "cn": [
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "usluga"
                    },
                    "name": "MyString209"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "tarif"
                    },
                    "name": "MyString210"
                },
                {
                    "type": "Ext.data.proxy.Memory",
                    "reference": {
                        "name": "proxy",
                        "type": "object"
                    },
                    "codeClass": null,
                    "name": "MyMemoryProxy4"
                }
            ]
        },
        "3a3f45c9-8296-40d1-96fa-09d6f7ea0e0e": {
            "type": "directstore",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "designer|userAlias": "stAddressOrg",
                "designer|userClassName": "StAddressOrg",
                "model": "MdAddress",
                "storeId": "stAddressOrg"
            },
            "cn": [
                {
                    "type": "Ext.data.proxy.Direct",
                    "reference": {
                        "name": "proxy",
                        "type": "object"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "directFn": "QueryLoad.getResults"
                    },
                    "name": "MyDirectProxy22",
                    "cn": [
                        {
                            "type": "Ext.data.reader.Json",
                            "reference": {
                                "name": "reader",
                                "type": "object"
                            },
                            "codeClass": null,
                            "userConfig": {
                                "rootProperty": "data"
                            },
                            "name": "MyJsonReader22"
                        }
                    ]
                }
            ]
        }
    },
    "boundModels": {
        "9dea8042-35a6-4377-801d-bfa607cc4198": {
            "type": "Ext.data.Model",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "designer|userClassName": "MdTarif"
            },
            "cn": [
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "raion"
                    },
                    "name": "MyInteger158"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "house_id"
                    },
                    "name": "MyInteger159"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "house"
                    },
                    "name": "MyString208"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "kv"
                    },
                    "name": "MyNumber213"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_kv"
                    },
                    "name": "MyNumber214"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "otoplenie"
                    },
                    "name": "MyNumber221"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "day_xv"
                    },
                    "name": "MyInteger91"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_otoplenie"
                    },
                    "name": "MyNumber223"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "podogrev"
                    },
                    "name": "MyNumber225"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_podogrev"
                    },
                    "name": "MyNumber226"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "gv"
                    },
                    "name": "MyNumber227"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_gv"
                    },
                    "name": "MyNumber228"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "gv16"
                    },
                    "name": "MyNumber229"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_gv16"
                    },
                    "name": "MyNumber230"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "xv"
                    },
                    "name": "MyNumber231"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_xv"
                    },
                    "name": "MyNumber232"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "stoki"
                    },
                    "name": "MyNumber235"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_stoki"
                    },
                    "name": "MyNumber236"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "st"
                    },
                    "name": "MyNumber237"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_st"
                    },
                    "name": "MyNumber238"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "tbo"
                    },
                    "name": "MyNumber241"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_tbo"
                    },
                    "name": "MyNumber242"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "tbo_kub"
                    },
                    "name": "MyNumber243"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "tbo_kub_man"
                    },
                    "name": "MyNumber244"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "kub_day"
                    },
                    "name": "MyNumber245"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "kub_mec"
                    },
                    "name": "MyNumber246"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "xvkub_lg"
                    },
                    "name": "MyNumber247"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "gvkub_lg"
                    },
                    "name": "MyNumber248"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "tbo_qty_kub"
                    },
                    "name": "MyNumber249"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "floor"
                    },
                    "name": "MyInteger160"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "voda"
                    },
                    "name": "MyNumber250"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "gkm2_lg"
                    },
                    "name": "MyNumber251"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "energy"
                    },
                    "name": "MyNumber"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_energy"
                    },
                    "name": "MyNumber1"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "kwh_nach"
                    },
                    "name": "MyInteger"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "kwh_osn_lg"
                    },
                    "name": "MyInteger1"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "kwh_dop_lg"
                    },
                    "name": "MyInteger2"
                },
                {
                    "type": "Ext.data.field.Date",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "data"
                    },
                    "name": "MyDate"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "kwh_mec"
                    },
                    "name": "MyNumber3"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "kwh_end_lg"
                    },
                    "name": "MyInteger90"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "vaxta"
                    },
                    "name": "MyNumber4"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_vaxta"
                    },
                    "name": "MyNumber5"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "square"
                    },
                    "name": "MyNumber2"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "gkal_nach"
                    },
                    "name": "MyNumber6"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "gkal"
                    },
                    "name": "MyNumber13"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "kvf1"
                    },
                    "name": "MyNumber14"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "ch_kvf1"
                    },
                    "name": "MyNumber15"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "lg"
                    },
                    "name": "MyNumber16"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "lgf1"
                    },
                    "name": "MyNumber17"
                }
            ]
        },
        "7b7a4c7c-5d5e-45db-b83e-602cf4c2b1ae": {
            "type": "Ext.data.Model",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "designer|userAlias": "mdHouses",
                "designer|userClassName": "MdHouses"
            },
            "cn": [
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "raion_id",
                        "sortType": null
                    },
                    "name": "MyInteger124"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "street_id",
                        "sortType": null
                    },
                    "name": "MyInteger125"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "house_id",
                        "sortType": null
                    },
                    "name": "MyInteger126"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "address_id"
                    },
                    "name": "MyInteger127"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "house"
                    },
                    "name": "MyString146"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "raion"
                    },
                    "name": "MyString147"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "street"
                    },
                    "name": "MyString148"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "item"
                    },
                    "name": "MyString149"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "address"
                    },
                    "name": "MyString150"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "appartment"
                    },
                    "name": "MyString151"
                }
            ]
        },
        "b58a2f76-8ea1-4462-8140-348ff00fc0f3": {
            "type": "Ext.data.Model",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "designer|userAlias": "mdAddress",
                "designer|userClassName": "MdAddress"
            },
            "cn": [
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "address_id",
                        "sortType": null
                    },
                    "name": "MyInteger128"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "raion_id",
                        "sortType": null
                    },
                    "name": "MyInteger129"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "street_id",
                        "sortType": null
                    },
                    "name": "MyInteger130"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "house_id",
                        "sortType": null
                    },
                    "name": "MyInteger131"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "address"
                    },
                    "name": "MyString152"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "raion"
                    },
                    "name": "MyString153"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "street"
                    },
                    "name": "MyString154"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "house"
                    },
                    "name": "MyString155"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "app"
                    },
                    "name": "MyString156"
                },
                {
                    "type": "Ext.data.field.Field",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "abbr"
                    },
                    "name": "MyField396"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "floor",
                        "sortType": null
                    },
                    "name": "MyInteger132"
                },
                {
                    "type": "Ext.data.field.Field",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "what"
                    },
                    "name": "MyField398"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "korp"
                    },
                    "name": "MyString157"
                },
                {
                    "type": "Ext.data.field.Field",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "pod"
                    },
                    "name": "MyField400"
                }
            ]
        }
    },
    "viewController": {
        "xdsVersion": "3.2.0",
        "frameworkVersion": "ext51",
        "internals": {
            "type": "Ext.app.ViewController",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "designer|userAlias": "tabkvartplata",
                "designer|userClassName": "sprav.TabKvartplataViewController"
            }
        },
        "linkedNodes": {},
        "boundStores": {},
        "boundModels": {}
    },
    "viewModel": {
        "xdsVersion": "3.2.0",
        "frameworkVersion": "ext51",
        "internals": {
            "type": "Ext.app.ViewModel",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "designer|userAlias": "tabkvartplata",
                "designer|userClassName": "sprav.TabKvartplataViewModel"
            }
        },
        "linkedNodes": {},
        "boundStores": {},
        "boundModels": {}
    }
}