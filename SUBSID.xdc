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
            "designer|userAlias": "tabsubsutszn",
            "designer|userClassName": "sprav.TabSubsUtszn",
            "height": null,
            "id": "tabSubsUtszn",
            "layout": "fit",
            "maxWidth": null,
            "minWidth": null,
            "scrollable": true,
            "title": "Сверка по субсидии",
            "width": 1458
        },
        "name": "sprav.TabKvartplata1",
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
                    "height": 700,
                    "id": "fmSubsUtszn",
                    "layout": "fit",
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
                            "name": "dockedItems",
                            "type": "array"
                        },
                        "codeClass": null,
                        "userConfig": {
                            "bodyBorder": true,
                            "bodyPadding": null,
                            "dock": "top",
                            "height": null,
                            "id": "grSubsUtszn",
                            "padding": 10,
                            "scrollable": true,
                            "store": "stSubsidiaUtszn",
                            "title": "",
                            "width": null
                        },
                        "name": "MyGridPanel1",
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
                                    "height": 700
                                },
                                "name": "MyGridView56",
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
                                                "record",
                                                "rowIndex",
                                                "rowParams",
                                                "store"
                                            ],
                                            "fn": "getRowClass",
                                            "implHandler": [
                                                " if(record.get('pr') === 0 ){",
                                                "     return 'change_color_yellow';",
                                                "",
                                                " } else  {",
                                                "     return  'change_color_green';",
                                                " }"
                                            ]
                                        },
                                        "name": "getRowClass"
                                    }
                                ]
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
                                    "frame": null,
                                    "width": 1440
                                },
                                "name": "MyToolbar9",
                                "configAlternates": {
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
                                            "fieldLabel": "Период",
                                            "format": "F,Y",
                                            "id": null,
                                            "itemId": null,
                                            "labelWidth": 55,
                                            "layout|flex": null,
                                            "name": "data_nach",
                                            "showToday": false,
                                            "startDay": 1,
                                            "submitFormat": "Ymd",
                                            "width": 201
                                        },
                                        "name": "MyDateField4",
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
                                                    "fn": "onDatefieldSelect1",
                                                    "implHandler": [
                                                        "  var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "        var values =stUser.getAt(0);",
                                                        "        var login = values.get('login');",
                                                        "        var password = values.get('password');",
                                                        "",
                                                        "        var StUtszn = Ext.data.StoreManager.get(\"stSubsidiaUtszn\");",
                                                        "        var btnGetSubsidiaUtszn =  Ext.getCmp('btnGetSubsidiaUtszn');",
                                                        "        var btnPrintSubsidiaUtszn =  Ext.getCmp('btnPrintSubsidiaUtszn');",
                                                        "        var btnReestrSubsidiaUtszn =  Ext.getCmp('btnReestrSubsidiaUtszn');",
                                                        "",
                                                        "        var form =  Ext.getCmp('fmSubsUtszn');",
                                                        "        var osmd_id = form.getForm().findField('osmd_id').getValue();",
                                                        "",
                                                        "        if (osmd_id){",
                                                        "        btnGetSubsidiaUtszn.setDisabled(false);",
                                                        "        btnPrintSubsidiaUtszn.setDisabled(false);",
                                                        "        btnReestrSubsidiaUtszn.setDisabled(false);",
                                                        "",
                                                        "        StUtszn.load({",
                                                        "            params: {",
                                                        "                what:'getSubsidiaUtszn',",
                                                        "                login:login,",
                                                        "                password:password,",
                                                        "                data:value,",
                                                        "                osmd_id: osmd_id",
                                                        "            },",
                                                        "            scope:this",
                                                        "        });",
                                                        "        }"
                                                    ],
                                                    "name": "select",
                                                    "scope": "me"
                                                },
                                                "name": "onDatefieldSelect1"
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
                                            "designer|displayName": null,
                                            "displayField": "osmd",
                                            "fieldLabel": "ОСМД",
                                            "labelAlign": null,
                                            "labelWidth": 45,
                                            "layout|flex": null,
                                            "name": "osmd_id",
                                            "queryMode": "local",
                                            "store": "StOsmd",
                                            "valueField": "osmd_id",
                                            "width": 276
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
                                                    "fn": "onComboboxSelect2111",
                                                    "implHandler": [
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "var values =stUser.getAt(0);",
                                                        "var login = values.get('login');",
                                                        "var password = values.get('password');",
                                                        "",
                                                        "var StUtszn = Ext.data.StoreManager.get(\"stSubsidiaUtszn\");",
                                                        "var btnGetSubsidiaUtszn =  Ext.getCmp('btnGetSubsidiaUtszn');",
                                                        "var btnPrintSubsidiaUtszn =  Ext.getCmp('btnPrintSubsidiaUtszn');",
                                                        "var btnReestrSubsidiaUtszn =  Ext.getCmp('btnReestrSubsidiaUtszn');",
                                                        "var btnInsDoplataSubsidiaUtszn =  Ext.getCmp('btnInsDoplataSubsidiaUtszn');",
                                                        "var btnInsPoplataSubsidiaUtszn =  Ext.getCmp('btnInsPoplataSubsidiaUtszn');",
                                                        "var btnInsOplataSubsidiaUtszn =  Ext.getCmp('btnInsOplataSubsidiaUtszn');",
                                                        "var form =  Ext.getCmp('fmSubsUtszn');",
                                                        "var oplata = form.getForm().findField('oplata').getValue();",
                                                        "var data = form.getForm().findField('data_nach').getValue();",
                                                        "       if (record) {",
                                                        "           values.set({'osmd_id':record.get('osmd_id')});",
                                                        "           stUser.sync();",
                                                        "           btnGetSubsidiaUtszn.setDisabled(false);",
                                                        "           btnPrintSubsidiaUtszn.setDisabled(false);",
                                                        "           btnReestrSubsidiaUtszn.setDisabled(false);",
                                                        "           btnInsOplataSubsidiaUtszn.setDisabled(false);",
                                                        "           btnInsPoplataSubsidiaUtszn.setDisabled(false);",
                                                        "           btnInsDoplataSubsidiaUtszn.setDisabled(false);",
                                                        "",
                                                        "           StUtszn.load({",
                                                        "               params: {",
                                                        "                   what:'getSubsidiaUtszn',",
                                                        "                   login:login,",
                                                        "                   password:password,",
                                                        "                   data:data,",
                                                        "                   osmd_id: record.get('osmd_id')",
                                                        "               },",
                                                        "               scope:this",
                                                        "           });",
                                                        "",
                                                        "       }",
                                                        ""
                                                    ],
                                                    "name": "select",
                                                    "scope": "me"
                                                },
                                                "name": "onComboboxSelect2111"
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.toolbar.Separator",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "height": 11,
                                            "layout|flex": null,
                                            "width": 10
                                        },
                                        "name": "MySeparator3"
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
                                            "icon": "resources/css/images/ico/printer.png",
                                            "iconCls": null,
                                            "id": "btnReestrSubsidiaUtszn",
                                            "itemId": null,
                                            "layout|flex": null,
                                            "text": "Реестр",
                                            "tooltip": null,
                                            "width": 94
                                        },
                                        "name": "MyButton1",
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
                                                        "var value = button.findParentByType('form').getValues();",
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "var tabPnCenter =  Ext.getCmp('tabPnCenter');",
                                                        "var StUtszn = Ext.data.StoreManager.get(\"stSubsidiaUtszn\");",
                                                        "",
                                                        "",
                                                        "var grid = button.findParentByType('grid');",
                                                        "var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();",
                                                        "var size = Ext.Object.getSize(gridRowSelectedRecords) ;",
                                                        "var form =  Ext.getCmp('fmSubsUtszn');",
                                                        "var osmd_id = form.getForm().findField('osmd_id').getValue();",
                                                        "var data_nach = form.getForm().findField('data_nach').getValue();",
                                                        "//  console.log(osmd_id);",
                                                        "//  console.log(data_nach);",
                                                        "                                        var values =stUser.getAt(0);",
                                                        "var login = values.get('login');",
                                                        "var password = values.get('password');",
                                                        "var params =[];",
                                                        "if (size >= 1){",
                                                        "    params = {",
                                                        "        login:values.get('login'),",
                                                        "        password:values.get('password'),",
                                                        "        what:\"ReestrSubsidiaUtsznAll\"",
                                                        "        ",
                                                        "    };",
                                                        "    ",
                                                        "    Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {",
                                                        "        Ext.Object.merge(val.data,params);",
                                                        "        ",
                                                        "        //console.log(val.data);",
                                                        "        ",
                                                        "        QueryAddress.updateRecords(val.data,function(results){",
                                                        "            if(results.res){",
                                                        "                return  true;",
                                                        "            }  else {",
                                                        "                return  false;",
                                                        "            }",
                                                        "        });",
                                                        "        ",
                                                        "    });",
                                                        "    ",
                                                        "    ",
                                                        "    setTimeout(function(){",
                                                        "        var report = 'ReestrSubsidiaUtsznAll';",
                                                        "        var namereport = 'Реестр';",
                                                        "        var value = {",
                                                        "            login:values.get('login'),",
                                                        "            password:values.get('password'),",
                                                        "            osmd_id:osmd_id,",
                                                        "            data:data_nach,",
                                                        "            report:report,",
                                                        "            what:report",
                                                        "        };",
                                                        "        ",
                                                        "        var tab = tabPnCenter.child('#'+report);",
                                                        "        if (!tab) {",
                                                        "            tab  = tabPnCenter.add({",
                                                        "                xtype:'tabreportorg',",
                                                        "                title:namereport,",
                                                        "                id:''+report+''",
                                                        "            });",
                                                        "            ",
                                                        "        }",
                                                        "        tabPnCenter.setActiveTab(tab);",
                                                        "        var reppan = tab.getComponent(0);",
                                                        "        // Basic mask:",
                                                        "        var myMask = Ext.Msg.show({",
                                                        "            title:'Выписка реестра...',",
                                                        "            msg: 'Выписка ...',",
                                                        "            buttons: Ext.Msg.CANCEL,",
                                                        "            wait: true,",
                                                        "            modal: true,",
                                                        "            icon: Ext.Msg.INFO",
                                                        "        });",
                                                        "        ",
                                                        "        QueryKassa.getRaspechatka(value,function(data){",
                                                        "            if (data){",
                                                        "                reppan.update(data.content);",
                                                        "                Ext.REPORTCONTENT =data.content;",
                                                        "                Ext.REPORTSQL =data.sql;",
                                                        "                Ext.REPORTTITLE =report;",
                                                        "                myMask.close();",
                                                        "                ",
                                                        "            } else {",
                                                        "                myMask.close();",
                                                        "                ",
                                                        "                Ext.MessageBox.show({",
                                                        "                    title: 'Ошибка ',",
                                                        "                    msg: 'Документ не создан',",
                                                        "                    buttons: Ext.MessageBox.OK,",
                                                        "                    icon: Ext.MessageBox.ERROR",
                                                        "                });",
                                                        "            }",
                                                        "        });",
                                                        "        ",
                                                        "    }, 1000);",
                                                        "}else {",
                                                        "    Ext.MessageBox.show({",
                                                        "        title: 'Ошибка ',",
                                                        "        msg: 'Не выбраны льготы для печати',",
                                                        "        buttons: Ext.MessageBox.OK,",
                                                        "        icon: Ext.MessageBox.ERROR",
                                                        "    });",
                                                        "}"
                                                    ]
                                                },
                                                "name": "handler"
                                            }
                                        ]
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
                                            "icon": "resources/css/images/ico/printer.png",
                                            "iconCls": null,
                                            "id": "btnPrintSubsidiaUtszn",
                                            "itemId": null,
                                            "layout|flex": null,
                                            "text": "Акты",
                                            "tooltip": null,
                                            "width": 85
                                        },
                                        "name": "MyButton3",
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
                                                        "var value = button.findParentByType('form').getValues();",
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "var tabPnCenter =  Ext.getCmp('tabPnCenter');",
                                                        "var StUtszn = Ext.data.StoreManager.get(\"stLgotaUtszn\");",
                                                        "",
                                                        "",
                                                        "var form =  Ext.getCmp('fmLgotaUtszn');",
                                                        "var osmd_id = form.getForm().findField('osmd_id').getValue();",
                                                        "var data = form.getForm().findField('data_nach').getValue();",
                                                        "",
                                                        "var values =stUser.getAt(0);",
                                                        "var login = values.get('login');",
                                                        "var password = values.get('password');",
                                                        "var params =[];",
                                                        "",
                                                        "var report = 'AktLgotaUtsznAll';",
                                                        "var namereport = 'Акт сверки';",
                                                        "var value = {",
                                                        "    login:values.get('login'),",
                                                        "    password:values.get('password'),",
                                                        "    osmd_id:osmd_id,",
                                                        "    report:report,",
                                                        "    data:data,",
                                                        "    what:report",
                                                        "};",
                                                        "",
                                                        "var tab = tabPnCenter.child('#'+report);",
                                                        "if (!tab) {",
                                                        "    tab  = tabPnCenter.add({",
                                                        "        xtype:'tabreportorg',",
                                                        "        title:namereport,",
                                                        "        id:''+report+''",
                                                        "    });",
                                                        "",
                                                        "}",
                                                        "tabPnCenter.setActiveTab(tab);",
                                                        "var reppan = tab.getComponent(0);",
                                                        "// Basic mask:",
                                                        "var myMask = Ext.Msg.show({",
                                                        "    title:'Выписка акта сверки...',",
                                                        "    msg: 'Выписка ...',",
                                                        "    buttons: Ext.Msg.CANCEL,",
                                                        "    wait: true,",
                                                        "    modal: true,",
                                                        "    icon: Ext.Msg.INFO",
                                                        "});",
                                                        "",
                                                        "QueryKassa.getRaspechatka(value,function(data){",
                                                        "    if (data){",
                                                        "        reppan.update(data.content);",
                                                        "        Ext.REPORTCONTENT =data.content;",
                                                        "        Ext.REPORTSQL =data.sql;",
                                                        "        Ext.REPORTTITLE =report;",
                                                        "        myMask.close();",
                                                        "",
                                                        "    } else {",
                                                        "        myMask.close();",
                                                        "        Ext.MessageBox.show({",
                                                        "            title: 'Ошибка ',",
                                                        "            msg: 'Документ не создан',",
                                                        "            buttons: Ext.MessageBox.OK,",
                                                        "            icon: Ext.MessageBox.ERROR",
                                                        "        });",
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
                                    },
                                    {
                                        "type": "Ext.toolbar.Separator",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "height": 11,
                                            "layout|flex": null,
                                            "width": 10
                                        },
                                        "name": "MySeparator4"
                                    }
                                ]
                            },
                            {
                                "type": "Ext.toolbar.Toolbar",
                                "reference": {
                                    "name": "dockedItems",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "dock": "top"
                                },
                                "name": "MyToolbar",
                                "cn": [
                                    {
                                        "type": "Ext.button.Button",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "disabled": true,
                                            "icon": "resources/css/images/ico/xsldbg_refresh.png",
                                            "iconCls": null,
                                            "id": "btnGetSubsidiaUtszn",
                                            "itemId": null,
                                            "layout|flex": null,
                                            "text": "Загрузить субсидии",
                                            "tooltip": null,
                                            "width": 171
                                        },
                                        "name": "MyButton2",
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
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "var values =stUser.getAt(0);",
                                                        "var grid = button.findParentByType('grid');",
                                                        "var store = grid.store;",
                                                        "var form =  Ext.getCmp('fmSubsUtszn');",
                                                        "var data = form.getForm().findField('data_nach').getValue();",
                                                        "var osmd_id = form.getForm().findField('osmd_id').getValue();",
                                                        "",
                                                        "",
                                                        "",
                                                        "//STORE",
                                                        "",
                                                        "//LOGIKA",
                                                        "var params = {",
                                                        "    login:values.get('login'),",
                                                        "    password:values.get('password'),",
                                                        "    data:data,",
                                                        "    osmd_id:osmd_id,",
                                                        "    what:'update_utszn_subsidia'",
                                                        "};",
                                                        "//console.log(params);",
                                                        "",
                                                        "//LOGIKA",
                                                        "var myMask= Ext.Msg.show({",
                                                        "    title:'Обновление записи...',",
                                                        "    msg: 'Обновление записей в базе Ожидайте...',",
                                                        "    buttons: Ext.Msg.CANCEL,",
                                                        "    wait: true,",
                                                        "    modal: true,",
                                                        "    icon: Ext.Msg.INFO",
                                                        "});",
                                                        "",
                                                        "QueryAddress.updateRecords(params,function(results){",
                                                        "    if(results.success===\"1\"){",
                                                        "        store.load({",
                                                        "            params: {",
                                                        "                what:'getSubsidiaUtszn',",
                                                        "                login:values.get('login'),",
                                                        "                data:data,",
                                                        "                osmd_id:osmd_id,",
                                                        "                password:values.get('password')",
                                                        "            }",
                                                        "        });",
                                                        "        ",
                                                        "        myMask.close();",
                                                        "        Ext.MessageBox.show({",
                                                        "            title: 'Обновление базы Субсидия',",
                                                        "            msg: results.msg,",
                                                        "            buttons: Ext.MessageBox.OK,",
                                                        "            icon: Ext.MessageBox.INFO",
                                                        "        });",
                                                        "    } else {",
                                                        "        myMask.close();",
                                                        "        Ext.MessageBox.show({",
                                                        "            title: 'Обновление базы Субсидия',",
                                                        "            msg: results.msg,",
                                                        "            buttons: Ext.MessageBox.OK,",
                                                        "            icon: Ext.MessageBox.ERROR",
                                                        "        });",
                                                        "        ",
                                                        "    }",
                                                        "    ",
                                                        "});"
                                                    ]
                                                },
                                                "name": "handler"
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
                                            "disabled": null,
                                            "fieldLabel": "оплата",
                                            "fieldStyle": "background-color:#F0F8FF;font-size:10pt;text-align:right;",
                                            "hideTrigger": true,
                                            "id": null,
                                            "labelWidth": 80,
                                            "layout|flex": null,
                                            "name": "oplata",
                                            "step": null,
                                            "value": [
                                                "0"
                                            ],
                                            "width": 200
                                        },
                                        "name": "MyNumberField35",
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
                                            "disabled": true,
                                            "icon": "resources/css/images/ico/yes.png",
                                            "iconCls": null,
                                            "id": "btnInsOplataSubsidiaUtszn",
                                            "itemId": null,
                                            "layout|flex": null,
                                            "text": "Текущая оплата",
                                            "tooltip": null,
                                            "width": 149
                                        },
                                        "name": "MyButton17",
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
                                                        "//COMBO",
                                                        "",
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "var values =stUser.getAt(0);",
                                                        "var grid = button.findParentByType('grid');",
                                                        "var store = grid.store;",
                                                        "var form =  Ext.getCmp('fmSubsUtszn');",
                                                        "var osmd_id = form.getForm().findField('osmd_id').getValue();",
                                                        "var data = form.getForm().findField('data_nach').getValue();",
                                                        "var oplata = form.getForm().findField('oplata').getValue();",
                                                        "var pr = 1;",
                                                        "",
                                                        "",
                                                        "//STORE",
                                                        "",
                                                        "//LOGIKA",
                                                        "var params = {",
                                                        "    login:values.get('login'),",
                                                        "    password:values.get('password'),",
                                                        "    data:data,",
                                                        "    osmd_id:osmd_id,",
                                                        "    oplata:oplata,",
                                                        "    pr:pr,",
                                                        "    what:'insOplataSubsidiaUtszn_kv'",
                                                        "};",
                                                        "//console.log(params);",
                                                        "",
                                                        "//LOGIKA",
                                                        "var myMask= Ext.Msg.show({",
                                                        "    title:'Обновление записи...',",
                                                        "    msg: 'Обновление записей в базе Ожидайте...',",
                                                        "    buttons: Ext.Msg.CANCEL,",
                                                        "    wait: true,",
                                                        "    modal: true,",
                                                        "    icon: Ext.Msg.INFO",
                                                        "});",
                                                        "",
                                                        "QueryAddress.updateRecords(params,function(results){",
                                                        "    if(results.success===\"1\"){",
                                                        "        store.load({",
                                                        "            params: {",
                                                        "                what:'getSubsidiaUtszn',",
                                                        "                login:values.get('login'),",
                                                        "                osmd_id:osmd_id,",
                                                        "                data:data,",
                                                        "                password:values.get('password')",
                                                        "            }",
                                                        "        });",
                                                        "",
                                                        "        myMask.close();",
                                                        "        Ext.MessageBox.show({",
                                                        "            title: 'Обновление базы ',",
                                                        "            msg: results.msg,",
                                                        "            buttons: Ext.MessageBox.OK,",
                                                        "            icon: Ext.MessageBox.INFO",
                                                        "        });",
                                                        "    } else {",
                                                        "        myMask.close();",
                                                        "        Ext.MessageBox.show({",
                                                        "            title: 'Обновление базы ',",
                                                        "            msg: results.msg,",
                                                        "            buttons: Ext.MessageBox.OK,",
                                                        "            icon: Ext.MessageBox.ERROR",
                                                        "        });",
                                                        "",
                                                        "    }",
                                                        "",
                                                        "});",
                                                        ""
                                                    ]
                                                },
                                                "name": "handler"
                                            }
                                        ]
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
                                            "icon": "resources/css/images/ico/yes.png",
                                            "iconCls": null,
                                            "id": "btnInsDoplataSubsidiaUtszn",
                                            "itemId": null,
                                            "layout|flex": null,
                                            "text": "Оплата прошлых периодов",
                                            "tooltip": null,
                                            "width": 214
                                        },
                                        "name": "MyButton18",
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
                                                        "//COMBO",
                                                        "",
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "var values =stUser.getAt(0);",
                                                        "var grid = button.findParentByType('grid');",
                                                        "var store = grid.store;",
                                                        "var form =  Ext.getCmp('fmSubsUtszn');",
                                                        "var osmd_id = form.getForm().findField('osmd_id').getValue();",
                                                        "var data = form.getForm().findField('data_nach').getValue();",
                                                        "var oplata = form.getForm().findField('oplata').getValue();",
                                                        "var pr = 2;",
                                                        "",
                                                        "",
                                                        "//STORE",
                                                        "",
                                                        "//LOGIKA",
                                                        "var params = {",
                                                        "    login:values.get('login'),",
                                                        "    password:values.get('password'),",
                                                        "    data:data,",
                                                        "    osmd_id:osmd_id,",
                                                        "    oplata:oplata,",
                                                        "    pr:pr,",
                                                        "    what:'insOplataSubsidiaUtszn_kv'",
                                                        "};",
                                                        "//console.log(params);",
                                                        "",
                                                        "//LOGIKA",
                                                        "var myMask= Ext.Msg.show({",
                                                        "    title:'Обновление записи...',",
                                                        "    msg: 'Обновление записей в базе Ожидайте...',",
                                                        "    buttons: Ext.Msg.CANCEL,",
                                                        "    wait: true,",
                                                        "    modal: true,",
                                                        "    icon: Ext.Msg.INFO",
                                                        "});",
                                                        "",
                                                        "QueryAddress.updateRecords(params,function(results){",
                                                        "    if(results.success===\"1\"){",
                                                        "        store.load({",
                                                        "            params: {",
                                                        "                what:'getSubsidiaUtszn',",
                                                        "                login:values.get('login'),",
                                                        "                osmd_id:osmd_id,",
                                                        "                data:data,",
                                                        "                password:values.get('password')",
                                                        "            }",
                                                        "        });",
                                                        "",
                                                        "        myMask.close();",
                                                        "        Ext.MessageBox.show({",
                                                        "            title: 'Обновление базы ',",
                                                        "            msg: results.msg,",
                                                        "            buttons: Ext.MessageBox.OK,",
                                                        "            icon: Ext.MessageBox.INFO",
                                                        "        });",
                                                        "    } else {",
                                                        "        myMask.close();",
                                                        "        Ext.MessageBox.show({",
                                                        "            title: 'Обновление базы ',",
                                                        "            msg: results.msg,",
                                                        "            buttons: Ext.MessageBox.OK,",
                                                        "            icon: Ext.MessageBox.ERROR",
                                                        "        });",
                                                        "",
                                                        "    }",
                                                        "",
                                                        "});",
                                                        ""
                                                    ]
                                                },
                                                "name": "handler"
                                            }
                                        ]
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
                                            "icon": "resources/css/images/ico/yes.png",
                                            "iconCls": null,
                                            "id": "btnInsPoplataSubsidiaUtszn",
                                            "itemId": null,
                                            "layout|flex": null,
                                            "text": "Оплата поставщикам",
                                            "tooltip": null,
                                            "width": 175
                                        },
                                        "name": "MyButton19",
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
                                                        "//COMBO",
                                                        "",
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "var values =stUser.getAt(0);",
                                                        "var grid = button.findParentByType('grid');",
                                                        "var store = grid.store;",
                                                        "var form =  Ext.getCmp('fmSubsUtszn');",
                                                        "var osmd_id = form.getForm().findField('osmd_id').getValue();",
                                                        "var data = form.getForm().findField('data_nach').getValue();",
                                                        "var oplata = form.getForm().findField('oplata').getValue();",
                                                        "var pr = 3;",
                                                        "",
                                                        "",
                                                        "//STORE",
                                                        "",
                                                        "//LOGIKA",
                                                        "var params = {",
                                                        "    login:values.get('login'),",
                                                        "    password:values.get('password'),",
                                                        "    data:data,",
                                                        "    osmd_id:osmd_id,",
                                                        "    oplata:oplata,",
                                                        "    pr:pr,",
                                                        "    what:'insOplataSubsidiaUtszn_kv'",
                                                        "};",
                                                        "//console.log(params);",
                                                        "",
                                                        "//LOGIKA",
                                                        "var myMask= Ext.Msg.show({",
                                                        "    title:'Обновление записи...',",
                                                        "    msg: 'Обновление записей в базе Ожидайте...',",
                                                        "    buttons: Ext.Msg.CANCEL,",
                                                        "    wait: true,",
                                                        "    modal: true,",
                                                        "    icon: Ext.Msg.INFO",
                                                        "});",
                                                        "",
                                                        "QueryAddress.updateRecords(params,function(results){",
                                                        "    if(results.success===\"1\"){",
                                                        "        store.load({",
                                                        "            params: {",
                                                        "                what:'getSubsidiaUtszn',",
                                                        "                login:values.get('login'),",
                                                        "                osmd_id:osmd_id,",
                                                        "                data:data,",
                                                        "                password:values.get('password')",
                                                        "            }",
                                                        "        });",
                                                        "",
                                                        "        myMask.close();",
                                                        "        Ext.MessageBox.show({",
                                                        "            title: 'Обновление базы ',",
                                                        "            msg: results.msg,",
                                                        "            buttons: Ext.MessageBox.OK,",
                                                        "            icon: Ext.MessageBox.INFO",
                                                        "        });",
                                                        "    } else {",
                                                        "        myMask.close();",
                                                        "        Ext.MessageBox.show({",
                                                        "            title: 'Обновление базы ',",
                                                        "            msg: results.msg,",
                                                        "            buttons: Ext.MessageBox.OK,",
                                                        "            icon: Ext.MessageBox.ERROR",
                                                        "        });",
                                                        "",
                                                        "    }",
                                                        "",
                                                        "});",
                                                        ""
                                                    ]
                                                },
                                                "name": "handler"
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                "type": "Ext.grid.column.RowNumberer",
                                "reference": {
                                    "name": "columns",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "name": "MyRowNumberer"
                            },
                            {
                                "type": "Ext.grid.column.Action",
                                "reference": {
                                    "name": "columns",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "icon": null,
                                    "menuDisabled": true,
                                    "tooltip": "Редактировать",
                                    "width": 30
                                },
                                "name": "MyActionColumn2",
                                "cn": [
                                    {
                                        "type": "actioncolumnitem",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "icon": "resources/css/images/ico/edit.png",
                                            "tooltip": "Редактировать"
                                        },
                                        "name": "MyActionColumnItem2",
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
                                                        "view",
                                                        "rowIndex",
                                                        "colIndex",
                                                        "item",
                                                        "e",
                                                        "record",
                                                        "row"
                                                    ],
                                                    "fn": "handler",
                                                    "implHandler": [
                                                        "var winprintaktutszn = Ext.ClassManager.instantiateByAlias('widget.winprintaktutszn');",
                                                        "var form = winprintaktutszn.down('#fmPrintAktUtszn');",
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "var values =stUser.getAt(0);",
                                                        "var value = record;",
                                                        "view.getSelectionModel().select(rowIndex);",
                                                        "form.loadRecord(value);",
                                                        "form.getForm().findField('vibor').setValue('1');",
                                                        "winprintaktutszn.show();"
                                                    ]
                                                },
                                                "name": "handler"
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                "type": "Ext.grid.column.Action",
                                "reference": {
                                    "name": "columns",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "designer|displayName": "Удалить запись",
                                    "flex": null,
                                    "maxWidth": null,
                                    "menuDisabled": true,
                                    "minWidth": null,
                                    "width": 30
                                },
                                "name": "MyActionColumn",
                                "configAlternates": {
                                    "scrollable": "boolean"
                                },
                                "cn": [
                                    {
                                        "type": "actioncolumnitem",
                                        "reference": {
                                            "name": "items",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "icon": "resources/css/images/ico/no.png",
                                            "tooltip": "Удалить  запись "
                                        },
                                        "name": "MyActionColumnItem63",
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
                                                        "view",
                                                        "rowIndex",
                                                        "colIndex",
                                                        "item",
                                                        "e",
                                                        "record",
                                                        "row"
                                                    ],
                                                    "fn": "handler",
                                                    "implHandler": [
                                                        "var stUser = Ext.data.StoreManager.get(\"StUser\");",
                                                        "var values =stUser.getAt(0);",
                                                        "var form =  Ext.getCmp('fmSubsUtszn');",
                                                        "var osmd_id = values.get('osmd_id');",
                                                        "var data = form.getForm().findField('data_nach').getValue();",
                                                        "",
                                                        "var params = {",
                                                        "    login:values.get('login'),",
                                                        "    password:values.get('password'),",
                                                        "    data:data,",
                                                        "    osmd_id:osmd_id,",
                                                        "    what:'delSubsidiaUtszn'",
                                                        "};",
                                                        "",
                                                        "//GRID",
                                                        "var store = view.getStore();",
                                                        "var value = store.getAt(rowIndex).data;",
                                                        "",
                                                        "",
                                                        "//LOGIKA",
                                                        "",
                                                        "",
                                                        "Ext.Object.merge(value, params);",
                                                        "//console.log(value);",
                                                        "",
                                                        "Ext.MessageBox.confirm({",
                                                        "    title: 'Удаление записи',",
                                                        "    msg: 'Вы удаляете запись   <br> Подтвердите или отмените свои действия.',",
                                                        "    buttons: Ext.MessageBox.OKCANCEL,",
                                                        "    icon: Ext.MessageBox.ERROR,",
                                                        "    buttonText:{",
                                                        "        ok:'подтвеждаю',",
                                                        "        cancel:'отмена'",
                                                        "    },",
                                                        "    fn:function(btn,newValue){",
                                                        "        if(btn=='ok'){",
                                                        "            QueryAddress.updateRecords(value,function(results){",
                                                        "                if(results.success===\"1\"){",
                                                        "                    store.load({",
                                                        "                        params: {",
                                                        "                            what:'getSubsidiaUtszn',",
                                                        "                            login:values.get('login'),",
                                                        "                            osmd_id:osmd_id,",
                                                        "                            data:data,",
                                                        "                            password:values.get('password')",
                                                        "                        }",
                                                        "                    });",
                                                        "",
                                                        "                    Ext.MessageBox.show({",
                                                        "                        title: 'Удаление записи',",
                                                        "                        msg: results.msg,",
                                                        "                        buttons: Ext.MessageBox.OK,",
                                                        "                        icon: Ext.MessageBox.INFO",
                                                        "                    });",
                                                        "                } else {",
                                                        "                    Ext.MessageBox.show({",
                                                        "                        title: 'Удаление записи',",
                                                        "                        msg: results.msg,",
                                                        "                        buttons: Ext.MessageBox.OK,",
                                                        "                        icon: Ext.MessageBox.ERROR",
                                                        "                    });",
                                                        "",
                                                        "                }",
                                                        "",
                                                        "            });",
                                                        "        }",
                                                        "    }",
                                                        "});"
                                                    ]
                                                },
                                                "name": "handler"
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                "type": "Ext.grid.column.Number",
                                "reference": {
                                    "name": "columns",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "dataIndex": "osmd_id",
                                    "format": "0",
                                    "hidden": true,
                                    "menuDisabled": true,
                                    "text": null,
                                    "width": null
                                },
                                "name": "MyNumberColumn314",
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
                                    "dataIndex": "pr",
                                    "format": "0",
                                    "hidden": true,
                                    "menuDisabled": true,
                                    "text": null,
                                    "width": null
                                },
                                "name": "MyNumberColumn44",
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
                                    "dataIndex": "address",
                                    "hidden": null,
                                    "menuDisabled": true,
                                    "text": "Адрес",
                                    "width": 148
                                },
                                "name": "MyColumn46",
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
                                    "dataIndex": "gr",
                                    "format": "0",
                                    "menuDisabled": true,
                                    "text": "Гр",
                                    "width": 34
                                },
                                "name": "MyNumberColumn45",
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
                                    "dataIndex": "house",
                                    "hidden": true,
                                    "menuDisabled": true,
                                    "text": "Дом",
                                    "width": 100
                                },
                                "name": "MyColumn266",
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
                                    "dataIndex": "osmd",
                                    "hidden": true,
                                    "menuDisabled": true,
                                    "text": "ОСМД",
                                    "width": 186
                                },
                                "name": "MyColumn45",
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
                                    "dataIndex": "mec",
                                    "hidden": true,
                                    "menuDisabled": true,
                                    "text": "мес",
                                    "width": 40
                                },
                                "name": "MyColumn49",
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
                                    "dataIndex": "edrpou",
                                    "format": "0",
                                    "hidden": true,
                                    "menuDisabled": true,
                                    "text": "ЕДРПОУ",
                                    "width": 70
                                },
                                "name": "MyNumberColumn41",
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
                                    "format": null,
                                    "hidden": true,
                                    "menuDisabled": true,
                                    "text": "дата",
                                    "width": 80
                                },
                                "name": "MyDateColumn"
                            },
                            {
                                "type": "Ext.grid.column.Number",
                                "reference": {
                                    "name": "columns",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "align": "right",
                                    "dataIndex": "zadol",
                                    "format": "0.00",
                                    "hidden": null,
                                    "menuDisabled": true,
                                    "summaryType": "sum",
                                    "text": "Сальдо<br>начало",
                                    "width": 85
                                },
                                "name": "MyNumberColumn",
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
                                                "val",
                                                "params",
                                                "data"
                                            ],
                                            "fn": "summaryRenderer",
                                            "implHandler": [
                                                "var n =Ext.util.Format.number(val,'0,000.00');",
                                                "if (val >= 0) {",
                                                "    return '<span style=\"color:#000; font-weight:bold;\">' + n + '</span>';",
                                                "} else  {",
                                                "    return '<span style=\"color:red; font-weight:bold;\">' + n + '</span>';",
                                                "}"
                                            ]
                                        },
                                        "name": "summaryRenderer"
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
                                    "menuDisabled": true,
                                    "text": "Начислено в текущем периоде"
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
                                            "align": "right",
                                            "dataIndex": "nachisleno",
                                            "format": "0.00",
                                            "hidden": null,
                                            "menuDisabled": true,
                                            "summaryType": "sum",
                                            "text": "факт",
                                            "width": 85
                                        },
                                        "name": "MyNumberColumn316",
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
                                                        "val",
                                                        "params",
                                                        "data"
                                                    ],
                                                    "fn": "summaryRenderer",
                                                    "implHandler": [
                                                        " var n =Ext.util.Format.number(val,'0,000.00');",
                                                        "if (val >= 0) {",
                                                        "    return '<span style=\"color:#000; font-weight:bold;\">' + n + '</span>';",
                                                        "} else  {",
                                                        "    return '<span style=\"color:red; font-weight:bold;\">' + n + '</span>';",
                                                        "}"
                                                    ]
                                                },
                                                "name": "summaryRenderer"
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.grid.column.Number",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "align": "right",
                                            "dataIndex": "norma",
                                            "format": "0.00",
                                            "hidden": null,
                                            "menuDisabled": true,
                                            "summaryType": "sum",
                                            "text": "норма",
                                            "width": 85
                                        },
                                        "name": "MyNumberColumn317",
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
                                                        "val",
                                                        "params",
                                                        "data"
                                                    ],
                                                    "fn": "summaryRenderer",
                                                    "implHandler": [
                                                        " var n =Ext.util.Format.number(val,'0,000.00');",
                                                        "if (val >= 0) {",
                                                        "    return '<span style=\"color:#000; font-weight:bold;\">' + n + '</span>';",
                                                        "} else  {",
                                                        "    return '<span style=\"color:red; font-weight:bold;\">' + n + '</span>';",
                                                        "}"
                                                    ]
                                                },
                                                "name": "summaryRenderer"
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.grid.column.Number",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "align": "right",
                                            "dataIndex": "perer",
                                            "format": "0.00",
                                            "menuDisabled": true,
                                            "summaryType": "sum",
                                            "text": "бюджет",
                                            "width": 85
                                        },
                                        "name": "MyNumberColumn6",
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
                                                        "val",
                                                        "params",
                                                        "data"
                                                    ],
                                                    "fn": "summaryRenderer",
                                                    "implHandler": [
                                                        "var n =Ext.util.Format.number(val,'0,000.00');",
                                                        "if (val >= 0) {",
                                                        "    return '<span style=\"color:#000; font-weight:bold;\">' + n + '</span>';",
                                                        "} else  {",
                                                        "    return '<span style=\"color:red; font-weight:bold;\">' + n + '</span>';",
                                                        "}"
                                                    ]
                                                },
                                                "name": "summaryRenderer"
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
                                    "menuDisabled": true,
                                    "text": "перечислено средств",
                                    "width": null
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
                                            "align": "right",
                                            "dataIndex": "oplata",
                                            "format": "0.00",
                                            "hidden": null,
                                            "menuDisabled": true,
                                            "summaryType": "sum",
                                            "text": "бюджет",
                                            "width": 85
                                        },
                                        "name": "MyNumberColumn43",
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
                                                        "val",
                                                        "params",
                                                        "data"
                                                    ],
                                                    "fn": "summaryRenderer",
                                                    "implHandler": [
                                                        " var n =Ext.util.Format.number(val,'0,000.00');",
                                                        "if (val >= 0) {",
                                                        "    return '<span style=\"color:#000; font-weight:bold;\">' + n + '</span>';",
                                                        "} else  {",
                                                        "    return '<span style=\"color:red; font-weight:bold;\">' + n + '</span>';",
                                                        "}"
                                                    ]
                                                },
                                                "name": "summaryRenderer"
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.grid.column.Number",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "align": "right",
                                            "dataIndex": "poplata",
                                            "format": "0.00",
                                            "hidden": null,
                                            "menuDisabled": true,
                                            "summaryType": "sum",
                                            "text": "поставщ",
                                            "width": 85
                                        },
                                        "name": "MyNumberColumn1",
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
                                                        "val",
                                                        "params",
                                                        "data"
                                                    ],
                                                    "fn": "summaryRenderer",
                                                    "implHandler": [
                                                        " var n =Ext.util.Format.number(val,'0,000.00');",
                                                        "if (val >= 0) {",
                                                        "    return '<span style=\"color:#000; font-weight:bold;\">' + n + '</span>';",
                                                        "} else  {",
                                                        "    return '<span style=\"color:red; font-weight:bold;\">' + n + '</span>';",
                                                        "}"
                                                    ]
                                                },
                                                "name": "summaryRenderer"
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                "type": "Ext.grid.column.Number",
                                "reference": {
                                    "name": "columns",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "align": "right",
                                    "dataIndex": "dolg",
                                    "format": "0.00",
                                    "menuDisabled": true,
                                    "summaryType": "sum",
                                    "text": "Сальдо<br>конец",
                                    "width": 85
                                },
                                "name": "MyNumberColumn8",
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
                                                "val",
                                                "params",
                                                "data"
                                            ],
                                            "fn": "summaryRenderer",
                                            "implHandler": [
                                                " var n =Ext.util.Format.number(val,'0,000.00');",
                                                "if (val >= 0) {",
                                                "    return '<span style=\"color:#000; font-weight:bold;\">' + n + '</span>';",
                                                "} else  {",
                                                "    return '<span style=\"color:red; font-weight:bold;\">' + n + '</span>';",
                                                "}"
                                            ]
                                        },
                                        "name": "summaryRenderer"
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
                                    "menuDisabled": true,
                                    "text": "Задолженность на начало года"
                                },
                                "name": "MyColumn5",
                                "cn": [
                                    {
                                        "type": "Ext.grid.column.Number",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "align": "right",
                                            "dataIndex": "st",
                                            "format": "0.00",
                                            "hidden": null,
                                            "menuDisabled": true,
                                            "summaryType": "sum",
                                            "text": "задол",
                                            "width": 85
                                        },
                                        "name": "MyNumberColumn316",
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
                                                        "val",
                                                        "params",
                                                        "data"
                                                    ],
                                                    "fn": "summaryRenderer",
                                                    "implHandler": [
                                                        "var n =Ext.util.Format.number(val,'0,000.00');",
                                                        "if (val >= 0) {",
                                                        "    return '<span style=\"color:#000; font-weight:bold;\">' + n + '</span>';",
                                                        "} else  {",
                                                        "    return '<span style=\"color:red; font-weight:bold;\">' + n + '</span>';",
                                                        "}"
                                                    ]
                                                },
                                                "name": "summaryRenderer"
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.grid.column.Number",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "align": "right",
                                            "dataIndex": "doplata",
                                            "format": "0.00",
                                            "menuDisabled": true,
                                            "summaryType": "sum",
                                            "text": "оплата",
                                            "width": 85
                                        },
                                        "name": "MyNumberColumn7",
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
                                                        "val",
                                                        "params",
                                                        "data"
                                                    ],
                                                    "fn": "summaryRenderer",
                                                    "implHandler": [
                                                        "var n =Ext.util.Format.number(val,'0,000.00');",
                                                        "if (val >= 0) {",
                                                        "    return '<span style=\"color:#000; font-weight:bold;\">' + n + '</span>';",
                                                        "} else  {",
                                                        "    return '<span style=\"color:red; font-weight:bold;\">' + n + '</span>';",
                                                        "}"
                                                    ]
                                                },
                                                "name": "summaryRenderer"
                                            }
                                        ]
                                    },
                                    {
                                        "type": "Ext.grid.column.Number",
                                        "reference": {
                                            "name": "columns",
                                            "type": "array"
                                        },
                                        "codeClass": null,
                                        "userConfig": {
                                            "align": "right",
                                            "dataIndex": "fin",
                                            "format": "0.00",
                                            "hidden": null,
                                            "menuDisabled": true,
                                            "summaryType": "sum",
                                            "text": "остаток",
                                            "width": 80
                                        },
                                        "name": "MyNumberColumn317",
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
                                                        "val",
                                                        "params",
                                                        "data"
                                                    ],
                                                    "fn": "summaryRenderer",
                                                    "implHandler": [
                                                        " var n =Ext.util.Format.number(val,'0,000.00');",
                                                        "if (val >= 0) {",
                                                        "    return '<span style=\"color:#000; font-weight:bold;\">' + n + '</span>';",
                                                        "} else  {",
                                                        "    return '<span style=\"color:red; font-weight:bold;\">' + n + '</span>';",
                                                        "}"
                                                    ]
                                                },
                                                "name": "summaryRenderer"
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
                                    "dataIndex": "inn",
                                    "menuDisabled": true,
                                    "text": "инн",
                                    "width": 105
                                },
                                "name": "MyColumn2",
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
                                    "dataIndex": "fio",
                                    "hidden": null,
                                    "menuDisabled": true,
                                    "text": "Ф.И.О.",
                                    "width": 136
                                },
                                "name": "MyColumn50",
                                "configAlternates": {
                                    "scrollable": "boolean"
                                }
                            },
                            {
                                "type": "Ext.selection.CheckboxModel",
                                "reference": {
                                    "name": "selModel",
                                    "type": "object"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "mode": "SIMPLE"
                                },
                                "name": "MyCheckboxSelectionModel"
                            },
                            {
                                "type": "Ext.grid.feature.Summary",
                                "reference": {
                                    "name": "features",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "userConfig": {
                                    "dock": "top"
                                },
                                "name": "MySummaryFeature"
                            },
                            {
                                "type": "Ext.grid.feature.GroupingSummary",
                                "reference": {
                                    "name": "features",
                                    "type": "array"
                                },
                                "codeClass": null,
                                "name": "MyGroupingSummaryFeature"
                            }
                        ]
                    }
                ]
            }
        ]
    },
    "linkedNodes": {},
    "boundStores": {
        "a2940105-a119-4d54-9496-7a86dcd098ec": {
            "type": "directstore",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "autoLoad": null,
                "autoSync": null,
                "designer|userAlias": "stSubsidiaUtszn",
                "designer|userClassName": "stSubsidiaUtszn",
                "groupDir": null,
                "groupField": null,
                "model": "MdUtszn",
                "storeId": "stSubsidiaUtszn"
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
                        "api": null,
                        "directFn": "QuerySprav.getResults",
                        "extraParams": [
                            " {'what':'getSubsidiaUtszn'}"
                        ]
                    },
                    "name": "MyDirectProxy52",
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
                            "name": "MyJsonReader54"
                        }
                    ]
                }
            ]
        },
        "dcc8e0fd-e377-4d27-bad2-c0c4f32f7fe3": {
            "type": "directstore",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "autoLoad": true,
                "designer|userClassName": "StOsmd",
                "model": "MdHouses",
                "storeId": "StOsmd"
            },
            "name": "StHousesOrg1",
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
                            "{'what':'getOsmd'}"
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
        }
    },
    "boundModels": {
        "98338e30-278c-4cfa-abde-e88c80911c99": {
            "type": "Ext.data.Model",
            "reference": {
                "name": "items",
                "type": "array"
            },
            "codeClass": null,
            "userConfig": {
                "designer|userAlias": "mdUtszn",
                "designer|userClassName": "MdUtszn",
                "idProperty": "rec_id"
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
                        "name": "rec_id"
                    },
                    "name": "MyInteger163"
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
                    "name": "MyInteger165"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "lgota_id"
                    },
                    "name": "MyInteger90"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "gr"
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
                        "name": "budjet"
                    },
                    "name": "MyNumber160"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "percent"
                    },
                    "name": "MyInteger93"
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
                    "name": "MyString218"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "osmd"
                    },
                    "name": "MyString219"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "edrpou"
                    },
                    "name": "MyString110"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "lgota"
                    },
                    "name": "MyString107"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "lgota_ua"
                    },
                    "name": "MyString108"
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
                    "name": "MyNumber161"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "nachisleno"
                    },
                    "name": "MyNumber258"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "subsidia"
                    },
                    "name": "MyNumber158"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "oplata"
                    },
                    "name": "MyNumber260"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "doplata"
                    },
                    "name": "MyNumber159"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "fin"
                    },
                    "name": "MyNumber164"
                },
                {
                    "type": "Ext.data.field.Date",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "dateFormat": null,
                        "name": "data"
                    },
                    "name": "MyDate36"
                },
                {
                    "type": "Ext.data.field.Date",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "dateFormat": null,
                        "name": "date_akt"
                    },
                    "name": "MyDate30"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "info"
                    },
                    "name": "MyString187"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "mec"
                    },
                    "name": "MyString109"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "god"
                    },
                    "name": "MyInteger94"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "boss"
                    },
                    "name": "MyString111"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "glavbuh"
                    },
                    "name": "MyString112"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "pr"
                    },
                    "name": "MyInteger92"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "osmd_id"
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
                        "name": "address_id"
                    },
                    "name": "MyInteger98"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "fio"
                    },
                    "name": "MyString115"
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
                    "name": "MyString116"
                },
                {
                    "type": "Ext.data.field.Field",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "inn"
                    },
                    "name": "MyField2"
                },
                {
                    "type": "Ext.data.field.Number",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "zadol"
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
                        "name": "dolg"
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
                        "name": "poplata"
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
                        "name": "norma"
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
                        "name": "perer"
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
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "edrpou"
                    },
                    "name": "MyInteger"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "abbr"
                    },
                    "name": "MyString"
                },
                {
                    "type": "Ext.data.field.Integer",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "osmd_id"
                    },
                    "name": "MyInteger2"
                },
                {
                    "type": "Ext.data.field.String",
                    "reference": {
                        "name": "fields",
                        "type": "array"
                    },
                    "codeClass": null,
                    "userConfig": {
                        "name": "osmd"
                    },
                    "name": "MyString113"
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
                "designer|userAlias": "spravtabsubsutszn",
                "designer|userClassName": "sprav.TabSubsUtsznViewController"
            },
            "name": "sprav.TabKvartplataViewController1"
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
                "designer|userAlias": "spravtabsubsutszn",
                "designer|userClassName": "sprav.TabSubsUtsznViewModel"
            },
            "name": "sprav.TabKvartplataViewModel1"
        },
        "linkedNodes": {},
        "boundStores": {},
        "boundModels": {}
    }
}