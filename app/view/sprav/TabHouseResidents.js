/*
 * File: app/view/sprav/TabHouseResidents.js
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

Ext.define('Osbb.view.sprav.TabHouseResidents', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.tabhouseresidents',

    requires: [
        'Osbb.view.sprav.TabHouseResidentsViewModel',
        'Ext.form.Panel',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.toolbar.Toolbar',
        'Ext.form.field.ComboBox',
        'Ext.toolbar.Separator',
        'Ext.button.Button',
        'Ext.form.field.Date',
        'Ext.grid.column.Number',
        'Ext.grid.column.Date',
        'Ext.selection.CheckboxModel'
    ],

    viewModel: {
        type: 'tabhouseresidents'
    },
    height: 762,
    id: 'tabHouseResidents',
    scrollable: true,
    width: 1082,
    layout: 'fit',
    bodyBorder: false,
    closable: true,
    title: 'Список жильцов по дому',
    defaultListenerScope: true,

    items: [
        {
            xtype: 'form',
            id: 'fmHouseResidents',
            scrollable: true,
            layout: 'fit',
            title: '',
            items: [
                {
                    xtype: 'gridpanel',
                    id: 'grHouseResidents',
                    padding: 10,
                    scrollable: true,
                    bodyBorder: true,
                    title: '',
                    store: 'StAppartmentOsmd',
                    dockedItems: [
                        {
                            xtype: 'toolbar',
                            dock: 'top',
                            items: [
                                {
                                    xtype: 'combobox',
                                    width: 350,
                                    fieldLabel: 'ОСМД',
                                    labelWidth: 50,
                                    name: 'osmd_id',
                                    displayField: 'osmd',
                                    queryMode: 'local',
                                    store: 'StOsmd',
                                    valueField: 'osmd_id',
                                    listeners: {
                                        select: 'onComboboxSelect211'
                                    }
                                },
                                {
                                    xtype: 'tbseparator',
                                    height: 13,
                                    width: 23
                                },
                                {
                                    xtype: 'combobox',
                                    disabled: true,
                                    hideMode: 'visibility',
                                    id: 'cbHouseOsmd',
                                    width: 182,
                                    fieldLabel: '',
                                    name: 'house_id',
                                    emptyText: 'Дом',
                                    displayField: 'house',
                                    queryMode: 'local',
                                    store: 'StHousesOsmd',
                                    valueField: 'house_id',
                                    listeners: {
                                        select: 'onCbTabLgotnikHouseSelect1'
                                    }
                                },
                                {
                                    xtype: 'button',
                                    handler: function(button, event) {
                                        var value = button.findParentByType('form').getValues();
                                        var stUser = Ext.data.StoreManager.get("StUser");
                                        var tabPnCenter =  Ext.getCmp('tabPnCenter');
                                        var grid = button.findParentByType('grid');
                                        var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
                                        var size = Ext.Object.getSize(gridRowSelectedRecords) ;
                                        var form =  Ext.getCmp('fmHouseResidents');
                                        var osmd_id = form.getForm().findField('osmd_id').getValue();
                                        var address_id = 0;
                                        var values =stUser.getAt(0);
                                        var login = values.get('login');
                                        var password = values.get('password');
                                        if (size >= 1){
                                            Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {
                                                address_id = val.data.address_id;
                                            });

                                            var report = 'AktSubsidiaAll';
                                            var namereport = 'Довідка';
                                            var value = {
                                                login:values.get('login'),
                                                password:values.get('password'),
                                                report:report,
                                                what:report,
                                                osmd_id:osmd_id,
                                                address_id:address_id
                                            };
                                            var tab = tabPnCenter.child('#'+report);
                                            if (!tab) {
                                                tab  = tabPnCenter.add({
                                                    xtype:'tabreportorg',
                                                    title:namereport,
                                                    id:''+report+''
                                                });
                                            }
                                            tabPnCenter.setActiveTab(tab);
                                            var reppan = tab.getComponent(0);
                                            // Basic mask:
                                            var myMask = Ext.Msg.show({
                                                title:'Выписка акта...',
                                                msg: 'Выписка ...',
                                                buttons: Ext.Msg.CANCEL,
                                                wait: true,
                                                modal: true,
                                                icon: Ext.Msg.INFO
                                            });

                                            QueryKassa.getRaspechatka(value,function(data){
                                                if (data){
                                                    reppan.update(data.content);
                                                    Ext.REPORTCONTENT =data.content;
                                                    Ext.REPORTSQL =data.sql;
                                                    Ext.REPORTTITLE =report;
                                                    myMask.close();
                                                } else {
                                                    myMask.close();
                                                    Ext.MessageBox.show({
                                                        title: 'Ошибка ',
                                                        msg: 'Документ не создан',
                                                        buttons: Ext.MessageBox.OK,
                                                        icon: Ext.MessageBox.ERROR
                                                    });
                                                }
                                            });
                                        }else {
                                            Ext.MessageBox.show({
                                                title: 'Ошибка ',
                                                msg: 'Не выбран адрес для печати',
                                                buttons: Ext.MessageBox.OK,
                                                icon: Ext.MessageBox.ERROR
                                            });
                                        }
                                    },
                                    hidden: true,
                                    id: 'btnPrintSpravkaSubsidia',
                                    width: 211,
                                    icon: 'resources/css/images/ico/printer.png',
                                    text: 'Печать актов  на субсидию'
                                },
                                {
                                    xtype: 'datefield',
                                    hidden: true,
                                    id: 'dataNachOsbb',
                                    width: 193,
                                    fieldLabel: 'Период',
                                    labelWidth: 55,
                                    format: 'F,Y',
                                    startDay: 1,
                                    submitFormat: 'Ymd'
                                },
                                {
                                    xtype: 'button',
                                    handler: function(button, e) {
                                        var value = button.findParentByType('form').getValues();
                                        var stUser = Ext.data.StoreManager.get("StUser");
                                        var tabPnCenter =  Ext.getCmp('tabPnCenter');


                                        var grid = button.findParentByType('grid');
                                        var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
                                        var size = Ext.Object.getSize(gridRowSelectedRecords) ;
                                        var form =  Ext.getCmp('fmHouseResidents');
                                        var osmd_id = form.getForm().findField('osmd_id').getValue();
                                        var house_id = form.getForm().findField('house_id').getValue();
                                        var data =  Ext.getCmp('dataNachOsbb').getValue();

                                        var values =stUser.getAt(0);
                                        var login = values.get('login');
                                        var password = values.get('password');
                                        var adr =[];
                                        if (size >= 1){

                                            Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {
                                                adr.push(val.data.address_id);
                                            });


                                            var report = 'raspechatkaApp';
                                            var namereport = 'Расчетные листки';
                                            var value = {
                                                login:values.get('login'),
                                                password:values.get('password'),
                                                report:report,
                                                what:report,
                                                date_from:data,
                                                osmd_id:osmd_id,
                                                house_id:house_id,
                                                adr:adr
                                            };
                                            var tab = tabPnCenter.child('#'+report);
                                            if (!tab) {
                                                tab  = tabPnCenter.add({
                                                    xtype:'tabreportorg',
                                                    title:namereport,
                                                    id:''+report+''
                                                });

                                                tabPnCenter.setActiveTab(tab);
                                            }else{

                                                tabPnCenter.setActiveTab(tab);
                                            }

                                            var reppan = tab.getComponent(0);
                                            var myMask= Ext.Msg.show({
                                                title:'Отчеты...',
                                                msg: 'Завантаження отчета.Ожідайте...',
                                                buttons: Ext.Msg.CANCEL,
                                                wait: true,
                                                modal: true,
                                                icon: Ext.Msg.INFO
                                            });
                                            QueryReport.getResults(value,function(data){
                                                if (data){
                                                    reppan.update(data.content);
                                                    Ext.REPORTCONTENT =data.content;
                                                    myMask.close();
                                                } else {
                                                    Ext.MessageBox.show({
                                                        title: 'Ошибка ',
                                                        msg: 'Документ не створено',
                                                        buttons: Ext.MessageBox.OK,
                                                        icon: Ext.MessageBox.ERROR
                                                    });
                                                }
                                            });
                                            myMask.close();
                                        }
                                    },
                                    hidden: true,
                                    id: 'btnPrintRaspechatka',
                                    width: 211,
                                    icon: 'resources/css/images/ico/printer.png',
                                    text: 'Печать расчетных листов'
                                }
                            ]
                        }
                    ],
                    columns: [
                        {
                            xtype: 'gridcolumn',
                            width: 174,
                            dataIndex: 'address',
                            menuDisabled: true,
                            text: 'Адрес'
                        },
                        {
                            xtype: 'numbercolumn',
                            width: 51,
                            dataIndex: 'address_id',
                            menuDisabled: true,
                            text: 'Ид',
                            format: '0'
                        },
                        {
                            xtype: 'gridcolumn',
                            width: 286,
                            dataIndex: 'nanim',
                            menuDisabled: true,
                            text: 'Главный наниматель'
                        },
                        {
                            xtype: 'gridcolumn',
                            hideable: false,
                            menuDisabled: true,
                            text: 'Количество жильцов',
                            columns: [
                                {
                                    xtype: 'numbercolumn',
                                    width: 52,
                                    dataIndex: 'tenant',
                                    menuDisabled: true,
                                    text: 'Проп',
                                    format: '0'
                                },
                                {
                                    xtype: 'numbercolumn',
                                    width: 71,
                                    dataIndex: 'podnan',
                                    menuDisabled: true,
                                    text: 'Поднан',
                                    format: '0'
                                },
                                {
                                    xtype: 'numbercolumn',
                                    width: 62,
                                    dataIndex: 'absent',
                                    menuDisabled: true,
                                    text: 'Отсут',
                                    format: '0'
                                }
                            ]
                        },
                        {
                            xtype: 'gridcolumn',
                            hideable: false,
                            menuDisabled: true,
                            text: 'Площадь',
                            columns: [
                                {
                                    xtype: 'numbercolumn',
                                    width: 71,
                                    dataIndex: 'area_full',
                                    menuDisabled: true,
                                    text: 'Полезн',
                                    format: '0.00'
                                },
                                {
                                    xtype: 'numbercolumn',
                                    width: 62,
                                    dataIndex: 'area_life',
                                    menuDisabled: true,
                                    text: 'Жилая ',
                                    format: '0.00'
                                },
                                {
                                    xtype: 'numbercolumn',
                                    width: 62,
                                    dataIndex: 'area_dop',
                                    menuDisabled: true,
                                    text: 'допол',
                                    format: '0.00'
                                },
                                {
                                    xtype: 'numbercolumn',
                                    width: 62,
                                    dataIndex: 'area_otopl',
                                    menuDisabled: true,
                                    text: 'отопл',
                                    format: '0.00'
                                }
                            ]
                        },
                        {
                            xtype: 'numbercolumn',
                            hidden: true,
                            width: 70,
                            dataIndex: 'edrpou',
                            menuDisabled: true,
                            text: 'ЕДРПОУ',
                            format: '0'
                        },
                        {
                            xtype: 'datecolumn',
                            hidden: true,
                            width: 80,
                            align: 'center',
                            dataIndex: 'data',
                            menuDisabled: true,
                            text: 'дата'
                        }
                    ],
                    selModel: {
                        selType: 'checkboxmodel',
                        mode: 'SIMPLE'
                    }
                }
            ]
        }
    ],

    onComboboxSelect211: function(combo, record, eOpts) {
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');
        var vibor = values.get('vibor');

        var btnPrintSpravkaSubsidia =  Ext.getCmp('btnPrintSpravkaSubsidia');
        var btnPrintRaspechatka =  Ext.getCmp('btnPrintRaspechatka');

        var form =  Ext.getCmp('fmHouseResidents');
        var Store = Ext.data.StoreManager.get("StHousesOsmd");
        var  cbHouse = form.getForm().findField('house_id');


        //LOGIN & PASSWORD


        //LOGIKA
        if (record) {
            cbHouse.clearValue();
            values.set({'osmd_id':record.get('osmd_id')});
            stUser.sync();
            Store.load({
                params: {
                    what:'getHousesOsmd',
                    login:login,
                    password:password,
                    osmd_id: record.get('osmd_id')
                },
                scope:this
            });

            if (!btnPrintSpravkaSubsidia.isHidden()){btnPrintSpravkaSubsidia.hide();}
            if (!btnPrintRaspechatka.isHidden()){btnPrintRaspechatka.hide();}

            cbHouse.setDisabled(false);

        }
    },

    onCbTabLgotnikHouseSelect1: function(combo, record, eOpts) {

        var stUser = Ext.data.StoreManager.get("StUser");
        var values =stUser.getAt(0);
        var vibor = values.get('vibor');

        var login = Ext.data.StoreManager.get("StUser").getAt(0).get('login');
        var password = Ext.data.StoreManager.get("StUser").getAt(0).get('password');
        var stHAppartment = Ext.data.StoreManager.get("StAppartmentOsmd");
        var btnPrintSpravkaSubsidia =  Ext.getCmp('btnPrintSpravkaSubsidia');
        var btnPrintRaspechatka =  Ext.getCmp('btnPrintRaspechatka');
        var dataNachOsbb =  Ext.getCmp('dataNachOsbb');
        var dt = new Date();
        var firstDay = Ext.Date.getFirstDateOfMonth( dt ) ;



        if (record) {
            btnPrintSpravkaSubsidia.show();
            btnPrintRaspechatka.show();
            dataNachOsbb.show();
            dataNachOsbb.setValue(Ext.Date.format(firstDay, 'Y-m-d'));


            stHAppartment.proxy.setExtraParam('what', 'TabHouseResidents');
            stHAppartment.proxy.setExtraParam('what_id',record.get("house_id"));
            stHAppartment.proxy.setExtraParam('login', login);
            stHAppartment.proxy.setExtraParam('password', password);
            stHAppartment.load();
        }
    }

});