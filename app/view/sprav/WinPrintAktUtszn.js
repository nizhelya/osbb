/*
 * File: app/view/sprav/WinPrintAktUtszn.js
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

Ext.define('Osbb.view.sprav.WinPrintAktUtszn', {
    extend: 'Ext.window.Window',
    alias: 'widget.winprintaktutszn',

    requires: [
        'Osbb.view.sprav.WinPrintAktUtsznViewModel',
        'Ext.form.Panel',
        'Ext.form.FieldSet',
        'Ext.button.Button',
        'Ext.form.field.Hidden',
        'Ext.form.field.Date',
        'Ext.form.field.Number'
    ],

    viewModel: {
        type: 'winprintaktutszn'
    },
    height: 630,
    id: 'winPrintAktUtszn',
    width: 355,
    layout: 'fit',
    title: 'Обновить  акт сверки с УТиСЗН',
    modal: true,

    items: [
        {
            xtype: 'form',
            id: 'fmPrintAktUtszn',
            layout: 'fit',
            title: '',
            items: [
                {
                    xtype: 'fieldset',
                    style: 'background-color: #DCDCDC;',
                    width: 415,
                    layout: 'absolute',
                    title: '',
                    items: [
                        {
                            xtype: 'button',
                            handler: function(button, e) {
                                // in use
                                //STORE
                                var me = this;
                                var stUser = Ext.data.StoreManager.get("StUser");
                                var values =stUser.getAt(0);
                                var value = button.findParentByType('form').getValues();
                                var form = button.findParentByType('form').getForm();
                                var vibor = form.findField('vibor').getValue();
                                var osmd_id = form.findField('osmd_id').getValue();


                                var w = '';

                                if (vibor == 1) {
                                    w =  "editSubsidiaUtszn";
                                    g =  "getSubsidiaUtszn";
                                    var StUtszn = Ext.data.StoreManager.get("stSubsidiaUtszn");


                                }else {
                                    w =  "editLgotaUtszn";
                                    g =  "getLgotaUtszn";
                                    var StUtszn = Ext.data.StoreManager.get("stLgotaUtszn");

                                }

                                //LOGIN & PASSWORD
                                var params = {
                                    login:values.get('login'),
                                    password:values.get('password'),
                                    osmd_id:osmd_id,
                                    usluga_id:values.get('usluga_id'),
                                    what:w

                                };

                                //LOGIKA

                                Ext.Object.merge(value, params);

                                QueryAddress.updateRecords(value,function(results){
                                    if(results.success==="1"){
                                        Ext.MessageBox.show({
                                            title: 'Редактирование записи  ',
                                            msg: results.msg,
                                            buttons: Ext.MessageBox.OK,
                                            icon: Ext.MessageBox.INFO
                                        });
                                        StUtszn.load({
                                            params: {
                                                what:g,
                                                osmd_id:osmd_id,
                                                usluga_id:values.get('usluga_id'),
                                                data: value.data,
                                                login:values.get('login'),
                                                password:values.get('password')
                                            },
                                            scope:this
                                        });
                                        me.up('#winPrintAktUtszn').close();
                                    } else {
                                        Ext.MessageBox.show({
                                            title: 'Редактирование записи ',
                                            msg: results.msg,
                                            buttons: Ext.MessageBox.OK,
                                            icon: Ext.MessageBox.ERROR
                                        });
                                    }

                                });

                            },
                            x: 110,
                            y: 525,
                            formBind: true,
                            margin: 5,
                            width: 200,
                            icon: 'resources/css/images/ico/yes.png',
                            scale: 'medium',
                            text: 'Обновить  акт сверки'
                        },
                        {
                            xtype: 'hiddenfield',
                            name: 'rec_id'
                        },
                        {
                            xtype: 'hiddenfield',
                            fieldLabel: 'Запись_ид',
                            name: 'house_id'
                        },
                        {
                            xtype: 'hiddenfield',
                            x: 170,
                            y: 510,
                            fieldLabel: 'Запись_ид',
                            name: 'osmd_id'
                        },
                        {
                            xtype: 'hiddenfield',
                            x: 390,
                            y: 245,
                            height: 20,
                            width: 200,
                            fieldLabel: 'Запись_ид',
                            labelWidth: 20,
                            name: 'vibor'
                        },
                        {
                            xtype: 'datefield',
                            x: 5,
                            y: 10,
                            width: 165,
                            fieldLabel: 'период ',
                            labelWidth: 55,
                            name: 'data',
                            fieldStyle: 'background-color:#C2D9C9;font-size:11pt;text-align:right;',
                            allowBlank: false,
                            hideTrigger: true,
                            submitFormat: 'Ymd'
                        },
                        {
                            xtype: 'textfield',
                            anchor: '',
                            x: 180,
                            y: 10,
                            width: 140,
                            fieldLabel: 'ИНН',
                            labelWidth: 35,
                            name: 'inn',
                            fieldStyle: 'background-color:#C2D9C9;font-size:11pt;text-align:right;'
                        },
                        {
                            xtype: 'fieldset',
                            x: 5,
                            y: 45,
                            height: 475,
                            style: 'background-color: #F1EEEE ;',
                            width: 310,
                            title: 'Начисление',
                            items: [
                                {
                                    xtype: 'button',
                                    handler: function(button, event) {
                                        var form = button.findParentByType('form').getForm();
                                        var vibor = form.findField('vibor').getValue();

                                        if (vibor == 1) {
                                            var grUtszn = Ext.getCmp("grSubsUtszn");

                                        }else {
                                            var grUtszn = Ext.getCmp("grLgotaUtszn");
                                        }
                                        var value  = grUtszn.getView().getSelectionModel().getSelection()[0];
                                        form.loadRecord(value);

                                    },
                                    anchor: '100%',
                                    formBind: true,
                                    margin: 0,
                                    width: 269,
                                    icon: 'resources/css/images/ico/refresh.png',
                                    text: 'Восстановить',
                                    tooltip: 'Восстановить'
                                },
                                {
                                    xtype: 'numberfield',
                                    anchor: '100%',
                                    margin: 10,
                                    fieldLabel: 'Сальдо на начало года',
                                    labelWidth: 160,
                                    name: 'st',
                                    value: 0,
                                    fieldStyle: 'background-color:yellow;font-size:12pt;text-align:right;',
                                    hideTrigger: true
                                },
                                {
                                    xtype: 'numberfield',
                                    anchor: '100%',
                                    margin: 10,
                                    fieldLabel: 'Долг на начало периода',
                                    labelWidth: 160,
                                    name: 'zadol',
                                    value: 0,
                                    fieldStyle: 'background-color:#F0F8FF;font-size:11pt;text-align:right;',
                                    hideTrigger: true
                                },
                                {
                                    xtype: 'fieldset',
                                    style: 'background-color: #DCDCDC;',
                                    title: 'Начислено в отчетном периоде',
                                    items: [
                                        {
                                            xtype: 'numberfield',
                                            anchor: '100%',
                                            fieldLabel: 'Фактически ',
                                            labelWidth: 160,
                                            name: 'nachisleno',
                                            value: 0,
                                            fieldStyle: 'background-color:#F0F8FF;font-size:11pt;text-align:right;',
                                            allowBlank: false,
                                            hideTrigger: true
                                        },
                                        {
                                            xtype: 'numberfield',
                                            anchor: '100%',
                                            fieldLabel: 'По нормам',
                                            labelWidth: 160,
                                            name: 'norma',
                                            value: 0,
                                            fieldStyle: 'background-color:#F0F8FF;font-size:11pt;text-align:right;',
                                            allowBlank: false,
                                            hideTrigger: true
                                        },
                                        {
                                            xtype: 'numberfield',
                                            anchor: '100%',
                                            fieldLabel: 'На бюджет',
                                            labelWidth: 160,
                                            name: 'perer',
                                            value: 0,
                                            fieldStyle: 'background-color:#F0F8FF;font-size:11pt;text-align:right;',
                                            allowBlank: false,
                                            hideTrigger: true
                                        }
                                    ]
                                },
                                {
                                    xtype: 'fieldset',
                                    style: 'background-color: #DCDCDC;',
                                    title: 'Оплата',
                                    items: [
                                        {
                                            xtype: 'numberfield',
                                            anchor: '100%',
                                            fieldLabel: 'Из бюджета',
                                            labelWidth: 160,
                                            name: 'oplata',
                                            value: 0,
                                            fieldStyle: 'background-color:#F0F8FF;font-size:11pt;text-align:right;',
                                            allowBlank: false,
                                            hideTrigger: true
                                        },
                                        {
                                            xtype: 'numberfield',
                                            anchor: '100%',
                                            fieldLabel: 'Поставщикам',
                                            labelWidth: 160,
                                            name: 'poplata',
                                            value: 0,
                                            fieldStyle: 'background-color:#F0F8FF;font-size:11pt;text-align:right;',
                                            allowBlank: false,
                                            hideTrigger: true
                                        },
                                        {
                                            xtype: 'numberfield',
                                            anchor: '100%',
                                            fieldLabel: 'Предыдущий период',
                                            labelWidth: 160,
                                            name: 'doplata',
                                            value: 0,
                                            fieldStyle: 'background-color:yellow;font-size:11pt;text-align:right;',
                                            allowBlank: false,
                                            hideTrigger: true
                                        }
                                    ]
                                },
                                {
                                    xtype: 'numberfield',
                                    margin: '0 0 0 10',
                                    width: 266,
                                    fieldLabel: 'Долг на конец периода',
                                    labelWidth: 160,
                                    name: 'dolg',
                                    value: 0,
                                    fieldStyle: 'background-color:#F0F8FF;font-size:11pt;text-align:right;',
                                    hideTrigger: true
                                },
                                {
                                    xtype: 'numberfield',
                                    margin: '10 0 0 10',
                                    width: 265,
                                    fieldLabel: 'Сальдо на конец года',
                                    labelWidth: 160,
                                    name: 'fin',
                                    value: 0,
                                    fieldStyle: 'background-color:yellow;font-size:12pt;text-align:right;',
                                    hideTrigger: true
                                },
                                {
                                    xtype: 'button',
                                    handler: function(button, e) {
                                        var form = button.findParentByType('form');
                                        var n = 0;
                                        var s = 0;

                                        var st = form.getForm().findField('st').getValue();
                                        var zadol = form.getForm().findField('zadol').getValue();
                                        var nachisleno = form.getForm().findField('nachisleno').getValue();
                                        var norma = form.getForm().findField('norma').getValue();
                                        var perer = form.getForm().findField('perer').getValue();

                                        var fin = form.getForm().findField('fin').getValue();
                                        var dolg = form.getForm().findField('dolg').getValue();
                                        var doplata = form.getForm().findField('doplata').getValue();
                                        var poplata = form.getForm().findField('poplata').getValue();
                                        var oplata = form.getForm().findField('oplata').getValue();

                                        n = st - doplata;

                                        s = zadol + perer - oplata -  doplata;

                                        form.getForm().findField('fin').setValue(n);
                                        form.getForm().findField('dolg').setValue(s);


                                    },
                                    anchor: '100%',
                                    formBind: true,
                                    margin: 5,
                                    width: 268,
                                    icon: 'resources/css/images/ico/yes.png',
                                    text: 'просчитать'
                                }
                            ]
                        },
                        {
                            xtype: 'button',
                            handler: function(button, event) {
                                this.up('#winPrintAktUtszn').close();
                            },
                            x: 5,
                            y: 530,
                            width: 100,
                            icon: 'resources/css/images/ico/delete.png',
                            scale: 'medium',
                            text: 'Отмена'
                        }
                    ]
                }
            ]
        }
    ]

});