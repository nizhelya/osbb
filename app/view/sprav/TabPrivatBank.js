/*
 * File: app/view/sprav/TabPrivatBank.js
 *
 * This file was generated by Sencha Architect version 3.2.0.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Ext JS 5.1.x library, under independent license.
 * License of Sencha Architect does not include license for Ext JS 5.1.x. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('Osbb.view.sprav.TabPrivatBank', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.tabprivatbank',

    requires: [
        'Osbb.view.sprav.TabPrivatBankViewModel',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.toolbar.Toolbar',
        'Ext.button.Button',
        'Ext.toolbar.Separator',
        'Ext.toolbar.Spacer',
        'Ext.form.field.Hidden',
        'Ext.grid.column.Number',
        'Ext.grid.column.Date',
        'Ext.form.field.Number',
        'Ext.grid.column.Action',
        'Ext.grid.plugin.BufferedRenderer',
        'Ext.grid.feature.Summary',
        'Ext.grid.plugin.RowEditing',
        'Ext.grid.feature.GroupingSummary',
        'Ext.selection.CheckboxModel'
    ],

    viewModel: {
        type: 'tabprivatbank'
    },
    scrollable: true,
    layout: 'fit',
    closable: true,
    title: 'Оплата через ПриватБанк',
    defaultListenerScope: true,

    listeners: {
        activate: 'onPanelActivate'
    },

    initConfig: function(instanceConfig) {
        var me = this,
            config = {
                items: [
                    {
                        xtype: 'gridpanel',
                        id: 'grPrivatBank',
                        scrollable: true,
                        title: '',
                        store: 'StPrivatBank',
                        viewConfig: {
                            getRowClass: function(record, rowIndex, rowParams, store) {
                                if(record.get('pr') === "0" ){
                                    return 'change_color_yellow';

                                } else  {
                                    return  'change_color_green';
                                }


                            },
                            emptyText: 'Платежи не загружены'
                        },
                        dockedItems: [
                            {
                                xtype: 'toolbar',
                                dock: 'top',
                                height: 45,
                                items: [
                                    {
                                        xtype: 'button',
                                        handler: function(button, event) {
                                            //in use
                                            var winImport = Ext.ClassManager.instantiateByAlias('widget.winimport');
                                            var form = Ext.getCmp('fmImport');
                                            var vibor =  'privatbank';
                                            winImport.setTitle('Загрузка реестра из ПриватБанка)');

                                            winImport.show();

                                            form.getForm().findField('vibor').setValue(vibor);


                                        },
                                        id: 'btnImportPrivatBank',
                                        width: 145,
                                        icon: 'resources/css/images/ico/door_in.png',
                                        text: 'Импорт Реестра'
                                    },
                                    {
                                        xtype: 'button',
                                        handler: function(button, event) {
                                            //in use
                                            var winImport = Ext.ClassManager.instantiateByAlias('widget.winimport');
                                            var form = Ext.getCmp('fmImport');
                                            var vibor =  'privatbank';
                                            winImport.setTitle('Загрузка оплаты из ПриватБанка)');

                                            winImport.show();

                                            form.getForm().findField('vibor').setValue(vibor);


                                        },
                                        hidden: true,
                                        id: 'btnImportOplataPrivatBank',
                                        width: 94,
                                        icon: 'resources/css/images/ico/door_in.png',
                                        text: 'Импорт'
                                    },
                                    {
                                        xtype: 'tbseparator'
                                    },
                                    {
                                        xtype: 'button',
                                        handler: function(button, event) {
                                            //COMBO
                                            var grid = button.findParentByType('grid');
                                            var store = grid.store;

                                            //STORE
                                            var stUser = Ext.data.StoreManager.get("StUser");
                                            var values =stUser.getAt(0);

                                            //LOGIKA
                                            var params = {
                                                login:values.get('login'),
                                                password:values.get('password'),
                                                what:'input_oplata_privatbank'
                                            };


                                            //LOGIKA
                                            var myMask= Ext.Msg.show({
                                                title:'Запись оплаты ПриватБанка...',
                                                msg: 'Запись в базу оплаты ЮКИС.Ожидайте...',
                                                buttons: Ext.Msg.CANCEL,
                                                wait: true,
                                                modal: true,
                                                icon: Ext.Msg.INFO
                                            });

                                            QueryAddress.updateRecords(params,function(results){
                                                if(results.success==="1"){

                                                    store.load({
                                                        params: {
                                                            what:'getPrivatBank',
                                                            login:values.get('login'),
                                                            password:values.get('password')
                                                        }
                                                    });
                                                    myMask.close();
                                                    grid.getView().refresh();

                                                    Ext.MessageBox.show({
                                                        title:'Запись оплаты ПриватБанк...',
                                                        msg: results.msg,
                                                        buttons: Ext.MessageBox.OK,
                                                        icon: Ext.MessageBox.INFO
                                                    });
                                                } else {
                                                    myMask.close();
                                                    Ext.MessageBox.show({
                                                        title:'Запись оплаты ПриватБанк...',
                                                        msg: results.msg,
                                                        buttons: Ext.MessageBox.OK,
                                                        icon: Ext.MessageBox.ERROR
                                                    });

                                                }

                                            });
                                        },
                                        width: 310,
                                        icon: 'resources/css/images/ico/add.png',
                                        text: 'Ввод реестра в базу оплаты'
                                    },
                                    {
                                        xtype: 'tbseparator'
                                    },
                                    {
                                        xtype: 'button',
                                        handler: function(button, event) {
                                            //COMBO

                                            //STORE
                                            var stUser = Ext.data.StoreManager.get("StUser");
                                            var values =stUser.getAt(0);

                                            //LOGIKA
                                            var params = {
                                                login:values.get('login'),
                                                password:values.get('password'),
                                                what:'control_oplata_privatbank'
                                            };


                                            //LOGIKA
                                            var myMask= Ext.Msg.show({
                                                title:'Контроль суммы ...',
                                                msg: 'Контроль суммы в базе оплате.Ожидайте...',
                                                buttons: Ext.Msg.CANCEL,
                                                wait: true,
                                                modal: true,
                                                icon: Ext.Msg.INFO
                                            });

                                            QueryAddress.updateRecords(params,function(results){
                                                if(results.success==="1"){

                                                    myMask.close();
                                                    Ext.MessageBox.show({
                                                        title:'Контроль суммы ...',
                                                        msg: results.msg,
                                                        buttons: Ext.MessageBox.OK,
                                                        icon: Ext.MessageBox.INFO
                                                    });
                                                } else {
                                                    myMask.close();
                                                    Ext.MessageBox.show({
                                                        title:'Контроль суммы ...',
                                                        msg: results.msg,
                                                        buttons: Ext.MessageBox.OK,
                                                        icon: Ext.MessageBox.ERROR
                                                    });

                                                }

                                            });
                                        },
                                        width: 189,
                                        icon: 'resources/css/images/ico/schet.png',
                                        text: 'Контроль сумм в оплате'
                                    },
                                    {
                                        xtype: 'tbspacer',
                                        width: 100
                                    },
                                    {
                                        xtype: 'hiddenfield',
                                        fieldLabel: 'Label',
                                        name: 'usluga'
                                    },
                                    {
                                        xtype: 'button',
                                        handler: function(button, event) {
                                            //in use
                                            var stUser = Ext.data.StoreManager.get("StUser");
                                            var values =stUser.getAt(0);
                                            var edrpou = values.get('edrpou');
                                            var winExportLgota = Ext.ClassManager.instantiateByAlias('widget.winexportlgota');
                                            var form = Ext.getCmp('fmExportBudjet');
                                            var vibor =  "privatbank";
                                            //var viborOsmd =  Ext.getCmp('viborOsmdPrivatBank').getRawValue();
                                            //var osmd_id =  Ext.getCmp('viborOsmdPrivatBank').getValue();
                                            var tema = form.getForm().findField('tema');
                                            var message = form.getForm().findField('message');
                                            var dt = new Date();

                                            winExportLgota.setTitle('Отправка начислений ОСББ Дельфин  ЕДРПОУ 39520809 в ПриватБанк ');
                                            tema.setValue("Долг за коммунальныу услуги по ОСББ Дельфин   ЕДРПОУ 39520809  на"+ Ext.Date.format(dt, 'F,Y'));
                                            message.setValue("Долг за коммунальныу услуги по ОСББ Дельфин  ЕДРПОУ 39520809  на   "+ Ext.Date.format(dt, 'F,Y'));




                                            winExportLgota.show();
                                            form.getForm().findField('data').setValue(Ext.Date.format(dt, 'F,Y'));
                                            form.getForm().findField('vibor').setValue("privatbank");
                                            form.getForm().findField('subjectTo').setValue('base@privatbank.ua');
                                            //form.getForm().findField('subjectTo').setValue('yis@yuzhny.com');
                                            form.getForm().findField('subjectFrom').setValue('delfin_osbb@ukr.net');


                                        },
                                        id: 'btnExportPrivatBank',
                                        text: 'Экспорт в Приватбанк '
                                    }
                                ]
                            }
                        ],
                        columns: [
                            {
                                xtype: 'numbercolumn',
                                hidden: true,
                                width: 60,
                                dataIndex: 'rec_id',
                                menuDisabled: true,
                                text: 'Запись',
                                format: '0'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 144,
                                dataIndex: 'nomer',
                                menuDisabled: true,
                                text: '№ документа'
                            },
                            {
                                xtype: 'numbercolumn',
                                hidden: true,
                                width: 60,
                                dataIndex: 'god',
                                menuDisabled: true,
                                text: 'Период',
                                format: '0'
                            },
                            {
                                xtype: 'numbercolumn',
                                hidden: true,
                                width: 55,
                                dataIndex: 'raion_id',
                                menuDisabled: true,
                                text: 'Район',
                                format: '0'
                            },
                            {
                                xtype: 'datecolumn',
                                width: 114,
                                dataIndex: 'data',
                                menuDisabled: true,
                                text: 'Дата платежа',
                                format: 'd-m-Y'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 144,
                                dataIndex: 'prixod',
                                menuDisabled: true,
                                text: 'Период оплаты'
                            },
                            {
                                xtype: 'numbercolumn',
                                width: 89,
                                dataIndex: 'address_id',
                                menuDisabled: true,
                                text: 'адрес_ид',
                                format: '0'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 144,
                                dataIndex: 'address',
                                menuDisabled: true,
                                text: 'Адрес'
                            },
                            {
                                xtype: 'gridcolumn',
                                width: 204,
                                dataIndex: 'fio',
                                menuDisabled: true,
                                text: 'ФИО'
                            },
                            {
                                xtype: 'numbercolumn',
                                summaryRenderer: function(val, params, data) {
                                    var n =Ext.util.Format.number(val,'0,000.00');
                                    if (val >= 0) {
                                        return '<span style="color:#000; font-weight:bold;">' + n + '</span>';
                                    } else  {
                                        return '<span style="color:red; font-weight:bold;">' + n + '</span>';
                                    }
                                },
                                summaryType: 'sum',
                                width: 90,
                                dataIndex: 'summa',
                                menuDisabled: true,
                                text: 'Сумма',
                                editor: {
                                    xtype: 'numberfield',
                                    hideTrigger: true
                                }
                            },
                            {
                                xtype: 'numbercolumn',
                                width: 32,
                                dataIndex: 'pr',
                                menuDisabled: true,
                                text: 'Пр',
                                format: '0',
                                editor: {
                                    xtype: 'numberfield',
                                    hideTrigger: true,
                                    allowDecimals: false,
                                    decimalPrecision: 0
                                }
                            },
                            {
                                xtype: 'actioncolumn',
                                editRenderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                    var val="";
                                    return val;
                                },
                                width: 30,
                                menuDisabled: true,
                                altText: 'Удалить запись',
                                icon: 'css/images/ico/no.png',
                                items: [
                                    {
                                        handler: function(view, rowIndex, colIndex, item, e, record, row) {
                                            var grid = view.findParentByType('grid');
                                            var store = view.getStore();
                                            var plugin = grid.getPlugin('rowEditPrivatBank');
                                            plugin.cancelEdit();
                                            Ext.MessageBox.show({
                                                title: 'Внимание!',
                                                msg: 'Вы удаляете запись ! Подтвердите или отмените свои действия!',
                                                buttons: Ext.MessageBox.OKCANCEL,
                                                icon: Ext.MessageBox.WARNING,

                                                buttonText:{
                                                    ok: "Удалить!",
                                                    cancel: "Отмена"
                                                },
                                                fn:function(btn){
                                                    if(btn=='ok'){
                                                        // view.getStore().removeAt(rowIndex);
                                                        store.remove(record);

                                                        store.sync({
                                                            success: function(){
                                                                Ext.MessageBox.show({title: 'Удаление записи',
                                                                    msg:'Запись удалена',
                                                                    buttons: Ext.MessageBox.OK,
                                                                    icon: Ext.MessageBox.INFO
                                                                });
                                                            },
                                                            failure: function(){
                                                                Ext.MessageBox.show({title: 'Удаление записи',
                                                                    msg:'Запись не удалена',
                                                                    buttons: Ext.MessageBox.OK,
                                                                    icon: Ext.MessageBox.ERROR
                                                                });

                                                            },
                                                            scope: this
                                                        });
                                                    }
                                                }

                                            });
                                        },
                                        icon: 'resources/css/images/ico/no.png'
                                    }
                                ]
                            }
                        ],
                        plugins: [
                            Ext.create('Ext.grid.plugin.BufferedRenderer', {

                            }),
                            Ext.create('Ext.grid.plugin.RowEditing', {
                                pluginId: 'rowEditPrivatBank',
                                listeners: {
                                    edit: 'onRowEditingEdit'
                                }
                            })
                        ],
                        features: [
                            {
                                ftype: 'summary',
                                dock: 'top'
                            },
                            {
                                ftype: 'groupingsummary',
                                id: 'groupPrivatBank',
                                depthToIndent: 1000,
                                startCollapsed: true
                            }
                        ],
                        selModel: Ext.create('Ext.selection.CheckboxModel', {
                            selType: 'checkboxmodel',
                            mode: 'SINGLE'
                        })
                    }
                ]
            };
        if (instanceConfig) {
            me.getConfigurator().merge(me, config, instanceConfig);
        }
        return me.callParent([config]);
    },

    onRowEditingEdit: function(editor, context, eOpts) {
        var grid = editor.grid;
        var store = grid.getStore();
        var sm = store.getUpdatedRecords();
        var data = grid.getSelectionModel();
        if(sm.length) {

            store.sync({

                success: function(){
                    store.load();
                },
                scope:this
            });
        }

    },

    onPanelActivate: function(component, eOpts) {
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        //console.log(stUser);

        var StPrivatBank = Ext.data.StoreManager.get("StPrivatBank");


        //LOGIN & PASSWORD
        var values =stUser.getAt(0);

        StPrivatBank.load({
            params: {
                what:'getPrivatBank',
                login:values.get('login'),
                password:values.get('password')
            }
        });

    }

});