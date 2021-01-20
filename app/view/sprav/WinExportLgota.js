/*
 * File: app/view/sprav/WinExportLgota.js
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

Ext.define('Osbb.view.sprav.WinExportLgota', {
    extend: 'Ext.window.Window',
    alias: 'widget.winexportlgota',

    requires: [
        'Osbb.view.sprav.WinExportLgotaViewModel',
        'Ext.form.Panel',
        'Ext.form.FieldSet',
        'Ext.form.field.TextArea',
        'Ext.button.Button',
        'Ext.form.field.Hidden',
        'Ext.form.field.Date'
    ],

    viewModel: {
        type: 'winexportlgota'
    },
    height: 393,
    id: 'winExportLgota',
    width: 449,
    layout: 'fit',
    title: 'Экспорт льгот в УТиСЗН',
    modal: true,

    items: [
        {
            xtype: 'form',
            id: 'fmExportBudjet',
            width: 455,
            bodyPadding: 10,
            title: '',
            items: [
                {
                    xtype: 'fieldset',
                    height: 328,
                    style: 'background-color: #DCDCDC;',
                    width: 410,
                    layout: 'absolute',
                    title: 'E-mail',
                    items: [
                        {
                            xtype: 'textfield',
                            x: 0,
                            y: 35,
                            width: 380,
                            fieldLabel: 'E-mail получателя',
                            labelWidth: 120,
                            name: 'subjectTo',
                            invalidText: 'Введен неправильный E-mail',
                            allowBlank: false,
                            vtype: 'email',
                            vtypeText: 'Введен неправильный E-mail'
                        },
                        {
                            xtype: 'textfield',
                            x: 0,
                            y: 65,
                            width: 380,
                            fieldLabel: 'E-mail отправителя',
                            labelWidth: 120,
                            name: 'subjectFrom',
                            invalidText: 'Введен неправильный E-mail',
                            allowBlank: false,
                            vtype: 'email',
                            vtypeText: 'Введите правильный E-mail'
                        },
                        {
                            xtype: 'textareafield',
                            x: 0,
                            y: 105,
                            width: 380,
                            fieldLabel: 'Тема сообщения',
                            labelWidth: 120,
                            name: 'tema',
                            allowBlank: false,
                            grow: true
                        },
                        {
                            xtype: 'textareafield',
                            x: 0,
                            y: 175,
                            width: 380,
                            fieldLabel: 'Текст сообщения',
                            labelWidth: 120,
                            name: 'message',
                            allowBlank: false,
                            grow: true
                        },
                        {
                            xtype: 'button',
                            x: 130,
                            y: 250,
                            formBind: true,
                            height: 30,
                            id: 'btExportBudjet',
                            width: 250,
                            icon: 'resources/css/images/ico/add.png',
                            text: 'Отправка сообщения с вложением'
                        },
                        {
                            xtype: 'hiddenfield',
                            x: 126,
                            y: -9,
                            fieldLabel: 'Label',
                            name: 'vibor'
                        },
                        {
                            xtype: 'hiddenfield',
                            x: 126,
                            y: -9,
                            fieldLabel: 'Label',
                            name: 'osmd_id'
                        },
                        {
                            xtype: 'button',
                            handler: function(button, event) {
                                button.up('#winExportLgota').close();
                            },
                            x: 10,
                            y: 250,
                            height: 30,
                            width: 80,
                            icon: 'resources/css/images/ico/delete.png',
                            text: 'Отмена'
                        },
                        {
                            xtype: 'datefield',
                            x: 0,
                            y: 0,
                            width: 380,
                            fieldLabel: 'Период начисления',
                            labelWidth: 220,
                            name: 'data',
                            format: 'F,Y',
                            submitFormat: 'Ymd'
                        }
                    ]
                }
            ]
        }
    ]

});