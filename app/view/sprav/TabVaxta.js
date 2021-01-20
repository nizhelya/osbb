/*
 * File: app/view/sprav/TabVaxta.js
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

Ext.define('Osbb.view.sprav.TabVaxta', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.tabvaxta',

    requires: [
        'Osbb.view.sprav.TabVaxtaViewModel',
        'Osbb.view.sprav.TabVaxtaViewController',
        'Ext.form.Panel',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.toolbar.Toolbar',
        'Ext.form.field.ComboBox',
        'Ext.form.field.Number',
        'Ext.button.Button',
        'Ext.selection.CheckboxModel',
        'Ext.grid.column.Number',
        'Ext.grid.column.Date',
        'Ext.panel.Tool',
        'Ext.form.FieldSet',
        'Ext.form.field.Checkbox',
        'Ext.form.field.TextArea',
        'Ext.form.field.Date'
    ],

    controller: 'tabvaxta',
    viewModel: {
        type: 'tabvaxta'
    },
    id: 'tabVaxta',
    maxWidth: 849,
    scrollable: true,
    width: 849,
    layout: 'fit',
    bodyBorder: false,
    closable: true,
    title: 'Вахта',
    defaultListenerScope: true,

    initConfig: function(instanceConfig) {
        var me = this,
            config = {
                items: [
                    {
                        xtype: 'form',
                        id: 'fmVaxta',
                        scrollable: true,
                        title: '',
                        items: [
                            {
                                xtype: 'gridpanel',
                                anchor: '100%',
                                id: 'grTarifHousesVaxta',
                                padding: 10,
                                scrollable: true,
                                width: 925,
                                bodyBorder: true,
                                title: 'Дома',
                                store: 'StTarif',
                                dockedItems: [
                                    {
                                        xtype: 'toolbar',
                                        dock: 'top',
                                        items: [
                                            {
                                                xtype: 'combobox',
                                                width: 220,
                                                fieldLabel: 'Дом',
                                                labelWidth: 45,
                                                name: 'house_id',
                                                displayField: 'house',
                                                queryMode: 'local',
                                                store: 'StHousesOrg',
                                                valueField: 'house_id',
                                                listeners: {
                                                    select: 'onComboboxSelect211'
                                                }
                                            },
                                            {
                                                xtype: 'combobox',
                                                id: 'cbTarifVaxta',
                                                width: 220,
                                                fieldLabel: 'услуга',
                                                labelWidth: 50,
                                                name: 'viborTarif',
                                                displayField: 'usluga',
                                                queryMode: 'local',
                                                store: 'StVaxtaTarif',
                                                valueField: 'tarif',
                                                listeners: {
                                                    select: {
                                                        fn: 'onCbTarifVaxtaSelect',
                                                        scope: 'controller'
                                                    }
                                                }
                                            },
                                            {
                                                xtype: 'numberfield',
                                                id: 'tarVaxta',
                                                width: 200,
                                                fieldLabel: 'значение',
                                                labelWidth: 80,
                                                name: 'tar',
                                                value: 0,
                                                fieldStyle: 'background-color:#F0F8FF;font-size:10pt;text-align:right;',
                                                hideTrigger: true,
                                                decimalPrecision: 3
                                            },
                                            {
                                                xtype: 'button',
                                                handler: function(button, event) {
                                                    // in use
                                                    var value = button.findParentByType('form').getValues();
                                                    //STORE
                                                    var stUser = Ext.data.StoreManager.get("StUser");
                                                    var StTarif = Ext.data.StoreManager.get("StTarif");

                                                    //LOGIN & PASSWORD
                                                    var tarif = Ext.getCmp('tarVaxta');
                                                    var viborTarif = Ext.getCmp('cbTarifVaxta');

                                                    //LOGIKA
                                                    var grid = Ext.getCmp('grTarifHousesVaxta');

                                                    var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
                                                    var size = Ext.Object.getSize(gridRowSelectedRecords) ;
                                                    var values =stUser.getAt(0);
                                                    var login = values.get('login');
                                                    var password = values.get('password');
                                                    var params =[];
                                                    if (size >= 1){
                                                        params = {
                                                            login:values.get('login'),
                                                            password:values.get('password'),
                                                            what:"vvod_tarif_vaxta",
                                                            name_tar:value.viborTarif,
                                                            new_tar:value.tar
                                                        };



                                                        Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {
                                                            Ext.Object.merge(val.data, params);
                                                            QueryAddress.updateRecords(val.data,function(results){
                                                                if(results.res){
                                                                    return  true;
                                                                }  else {
                                                                    return  false;
                                                                }
                                                            });

                                                        });

                                                        StTarif.load({
                                                            params: {
                                                                what:'TarifFromHouse',
                                                                login:login,
                                                                password:password,
                                                                house_id: value.house_id
                                                            },
                                                            callback: function(records,operation,success){
                                                                if(success){
                                                                    viborTarif.clearValue();
                                                                    viborTarif.setDisabled(true);
                                                                    button.setDisabled(true);
                                                                    tarif.setValue(0);
                                                                }
                                                            },
                                                            scope:this
                                                        });

                                                    }
                                                },
                                                disabled: true,
                                                id: 'btnInsTarifVaxta',
                                                width: 135,
                                                icon: 'resources/css/images/ico/yes.png',
                                                text: 'Записать '
                                            }
                                        ]
                                    }
                                ],
                                selModel: Ext.create('Ext.selection.CheckboxModel', {
                                    selType: 'checkboxmodel',
                                    mode: 'SINGLE',
                                    showHeaderCheckbox: true
                                }),
                                columns: [
                                    {
                                        xtype: 'numbercolumn',
                                        hidden: true,
                                        dataIndex: 'raion',
                                        text: 'Raion'
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        width: 58,
                                        dataIndex: 'house_id',
                                        menuDisabled: true,
                                        text: 'ид',
                                        format: '0'
                                    },
                                    {
                                        xtype: 'datecolumn',
                                        width: 105,
                                        align: 'center',
                                        dataIndex: 'data',
                                        menuDisabled: true,
                                        text: 'дата',
                                        format: 'F,y'
                                    },
                                    {
                                        xtype: 'gridcolumn',
                                        width: 158,
                                        dataIndex: 'house',
                                        menuDisabled: true,
                                        text: 'Дом'
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        width: 58,
                                        dataIndex: 'floor',
                                        menuDisabled: true,
                                        text: 'Эт',
                                        format: '0'
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        width: 102,
                                        align: 'center',
                                        dataIndex: 'vaxta',
                                        menuDisabled: true,
                                        text: 'Тариф',
                                        format: '0.00'
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        width: 104,
                                        align: 'center',
                                        dataIndex: 'ch_vaxta',
                                        menuDisabled: true,
                                        text: 'Перер',
                                        format: '0.00'
                                    },
                                    {
                                        xtype: 'numbercolumn',
                                        width: 104,
                                        align: 'center',
                                        dataIndex: 'square',
                                        menuDisabled: true,
                                        text: 'Площадь',
                                        format: '0.00'
                                    }
                                ],
                                tools: [
                                    {
                                        xtype: 'tool',
                                        callback: function(owner, tool, event) {
                                            //STORE
                                            var stUser = Ext.data.StoreManager.get("StUser");
                                            var StTarif = Ext.data.StoreManager.get("StTarif");
                                            //LOGIN & PASSWORD
                                            var values =stUser.getAt(0);
                                            var login = values.get('login');
                                            var password = values.get('password');
                                            // FORM
                                            var tarif = Ext.getCmp('tarVaxta');
                                            var viborTarif = Ext.getCmp('cbTarifVaxta');
                                            var form = tool.findParentByType('form');
                                            var value = form.getValues();

                                            StTarif.load({
                                                params: {
                                                    what:'TarifFromHouseAll',
                                                    login:login,
                                                    password:password,
                                                    house_id: value.house_id
                                                },
                                                callback: function(records,operation,success){
                                                    if(success){
                                                        viborTarif.clearValue();
                                                        viborTarif.setDisabled(true);
                                                        tarif.setValue(0);
                                                    }
                                                },
                                                scope:this
                                            });

                                        },
                                        type: 'search'
                                    }
                                ]
                            },
                            {
                                xtype: 'panel',
                                anchor: '100%',
                                height: 362,
                                padding: 10,
                                layout: 'fit',
                                animCollapse: true,
                                title: 'Начисление и перерасчет по электроэнергии',
                                titleCollapse: true,
                                items: [
                                    {
                                        xtype: 'fieldset',
                                        height: 262,
                                        padding: '',
                                        style: 'background-color: #DCDCDC;',
                                        width: 908,
                                        layout: 'absolute',
                                        title: '',
                                        items: [
                                            {
                                                xtype: 'checkboxfield',
                                                x: 10,
                                                y: 60,
                                                style: 'background-color: #F1EEEE ;',
                                                fieldLabel: 'тарифы установлены вручную',
                                                labelWidth: 230,
                                                name: 'tarif_manual',
                                                boxLabel: '',
                                                inputValue: '1',
                                                uncheckedValue: '0'
                                            },
                                            {
                                                xtype: 'textareafield',
                                                x: 15,
                                                y: 145,
                                                style: 'background-color: #F1EEEE ;',
                                                width: 465,
                                                fieldLabel: 'Инфо перер',
                                                name: 'info'
                                            },
                                            {
                                                xtype: 'numberfield',
                                                x: 15,
                                                y: 100,
                                                style: 'background-color: #F1EEEE ;',
                                                width: 130,
                                                fieldLabel: 'действ',
                                                labelWidth: 50,
                                                name: 'vaxta',
                                                hideTrigger: true,
                                                decimalPrecision: 3
                                            },
                                            {
                                                xtype: 'numberfield',
                                                x: 150,
                                                y: 100,
                                                style: 'background-color: #F1EEEE ;',
                                                width: 130,
                                                fieldLabel: 'новый',
                                                labelWidth: 50,
                                                name: 'ch_vaxta',
                                                hideTrigger: true,
                                                decimalPrecision: 3
                                            },
                                            {
                                                xtype: 'fieldset',
                                                x: 290,
                                                y: 50,
                                                height: 85,
                                                style: 'background-color: #F1EEEE ;',
                                                width: 190,
                                                title: 'Период перерасчета',
                                                items: [
                                                    {
                                                        xtype: 'datefield',
                                                        anchor: '100%',
                                                        width: 185,
                                                        fieldLabel: 'Дата с',
                                                        labelWidth: 60,
                                                        name: 'sdata',
                                                        format: 'd-m-Y',
                                                        submitFormat: 'Ymd'
                                                    },
                                                    {
                                                        xtype: 'datefield',
                                                        anchor: '100%',
                                                        width: 185,
                                                        fieldLabel: 'Дата по',
                                                        labelWidth: 60,
                                                        name: 'fdata',
                                                        format: 'd-m-Y',
                                                        submitFormat: 'Ymd'
                                                    }
                                                ]
                                            },
                                            {
                                                xtype: 'checkboxfield',
                                                handler: function(checkbox, checked) {
                                                    var form = checkbox.findParentByType('form');
                                                    var  address_ot = form.getForm().findField('address_ot');
                                                    var  address_do = form.getForm().findField('address_do');

                                                    if(checked===true){
                                                        if (address_ot.isVisible()) address_ot.hide();
                                                        if (address_do.isVisible()) address_do.hide();
                                                    } else {
                                                        if (address_ot.isHidden()) address_ot.show();
                                                        if (address_do.isHidden()) address_do.show();

                                                    }
                                                },
                                                x: 490,
                                                y: 60,
                                                style: 'background-color: #F1EEEE ;',
                                                fieldLabel: 'По всем квартирам дома',
                                                labelWidth: 200,
                                                name: 'allkv',
                                                boxLabel: '',
                                                checked: true,
                                                inputValue: '1',
                                                uncheckedValue: '0'
                                            },
                                            {
                                                xtype: 'combobox',
                                                x: 530,
                                                y: 90,
                                                hidden: true,
                                                style: 'background-color: #C2D9E9;',
                                                width: 185,
                                                fieldLabel: 'c',
                                                labelWidth: 20,
                                                name: 'address_ot',
                                                enableKeyEvents: true,
                                                displayField: 'address',
                                                forceSelection: true,
                                                queryMode: 'local',
                                                store: 'StAddressOrg',
                                                valueField: 'address_id'
                                            },
                                            {
                                                xtype: 'combobox',
                                                x: 530,
                                                y: 120,
                                                hidden: true,
                                                style: 'background-color: #C2D9E9;',
                                                width: 185,
                                                fieldLabel: 'по',
                                                labelWidth: 20,
                                                name: 'address_do',
                                                editable: false,
                                                displayField: 'address',
                                                forceSelection: true,
                                                queryMode: 'local',
                                                store: 'StAddressOrg',
                                                valueField: 'address_id'
                                            },
                                            {
                                                xtype: 'button',
                                                x: 490,
                                                y: 165,
                                                disabled: true,
                                                id: 'btAddPererVaxta',
                                                width: 295,
                                                icon: 'resources/css/images/ico/add.png',
                                                text: 'Перерасчитать вахту  за период'
                                            },
                                            {
                                                xtype: 'datefield',
                                                x: 10,
                                                y: 15,
                                                style: 'background-color: #F1EEEE ;',
                                                width: 267,
                                                fieldLabel: 'Период начисления',
                                                labelWidth: 130,
                                                name: 'data_nach',
                                                readOnly: true,
                                                format: 'F,Y',
                                                startDay: 1,
                                                submitFormat: 'Ymd'
                                            },
                                            {
                                                xtype: 'button',
                                                x: 290,
                                                y: 15,
                                                formBind: false,
                                                disabled: true,
                                                id: 'btAddNachVaxta',
                                                width: 490,
                                                icon: 'resources/css/images/ico/add.png',
                                                text: 'начислить вахту  за период'
                                            },
                                            {
                                                xtype: 'button',
                                                x: 15,
                                                y: 235,
                                                formBind: false,
                                                disabled: true,
                                                id: 'btAddNachVaxtaPrev',
                                                width: 360,
                                                icon: 'resources/css/images/ico/add.png',
                                                text: 'начислить вахту  за предыдущий период'
                                            },
                                            {
                                                xtype: 'button',
                                                handler: function(button, event) {
                                                    //STORE
                                                    var stUser = Ext.data.StoreManager.get("StUser");

                                                    var values =stUser.getAt(0);
                                                    var login = values.get('login');
                                                    var password = values.get('password');

                                                    params = {
                                                        login:values.get('login'),
                                                        password:values.get('password'),
                                                        what:"clear_pr_vaxta"

                                                    };
                                                    QueryAddress.updateRecords(params,function(results){
                                                        if(results.res){
                                                            Ext.MessageBox.show({
                                                                title: 'Сброс защиты ',
                                                                msg: 'Можно начислять вахту',
                                                                buttons: Ext.MessageBox.OK,
                                                                icon: Ext.MessageBox.INFO
                                                            });

                                                        }
                                                    });



                                                },
                                                x: 785,
                                                y: 15,
                                                disabled: true,
                                                id: 'btnClearNachVaxta',
                                                icon: 'resources/css/images/ico/no.png',
                                                iconAlign: 'bottom',
                                                text: '',
                                                tooltip: 'Сброс признака <br>Квартплата  начислена'
                                            }
                                        ]
                                    }
                                ]
                            }
                        ]
                    }
                ]
            };
        if (instanceConfig) {
            me.getConfigurator().merge(me, config, instanceConfig);
        }
        return me.callParent([config]);
    },

    onComboboxSelect211: function(combo, record, eOpts) {
        //in use

        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var StTarif = Ext.data.StoreManager.get("StTarif");
        var tarif = Ext.getCmp('tarVaxta');
        var viborTarif = Ext.getCmp('cbTarifVaxta');
        var form = combo.findParentByType('form');
        //var data = form.getForm().findField('data').getValue();

        //LOGIN & PASSWORD

        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');

        //LOGIKA
        if (record) {
            StTarif.load({
                params: {
                    what:'TarifFromHouse',
                    login:login,
                    password:password,
                    //data:data,
                    house_id: record.get('house_id')
                },
                callback: function(records,operation,success){
                    if(success){
                        viborTarif.clearValue();
                        viborTarif.setDisabled(true);
                        tarif.setValue(0);
                    }
                },
                scope:this
            });
        }
    }

});