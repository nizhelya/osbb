/*
 * File: app/view/sprav/winAddTeplomer.js
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

Ext.define('Osbb.view.sprav.winAddTeplomer', {
    extend: 'Ext.window.Window',
    alias: 'widget.winaddteplomer',

    requires: [
        'Osbb.view.sprav.winAddTeplomerViewModel',
        'Ext.form.Panel',
        'Ext.form.field.Hidden',
        'Ext.button.Button',
        'Ext.form.FieldSet',
        'Ext.form.field.Number',
        'Ext.form.field.ComboBox',
        'Ext.form.field.Date'
    ],

    viewModel: {
        type: 'winaddteplomer'
    },
    height: 486,
    id: 'winAddTeplomer',
    width: 466,
    layout: 'fit',
    title: 'Ввод нового тепломера',
    modal: true,
    defaultListenerScope: true,

    items: [
        {
            xtype: 'form',
            height: 441,
            id: 'fmAddTeplomer',
            layout: 'absolute',
            bodyPadding: 10,
            title: '',
            items: [
                {
                    xtype: 'hiddenfield',
                    fieldLabel: 'Label',
                    name: 'teplomer_id'
                },
                {
                    xtype: 'button',
                    x: 240,
                    y: 400,
                    formBind: true,
                    id: 'btAddTeplomer',
                    width: 180,
                    icon: 'resources/css/images/ico/add.png',
                    text: 'Добавить тепломер'
                },
                {
                    xtype: 'button',
                    handler: function(button, event) {
                        this.up('#winAddTeplomer').close();
                    },
                    x: 40,
                    y: 400,
                    width: 80,
                    icon: 'resources/css/images/ico/delete.png',
                    text: 'Отмена'
                },
                {
                    xtype: 'fieldset',
                    x: 30,
                    y: 70,
                    height: 310,
                    style: 'background-color: #DCDCDC;',
                    width: 390,
                    layout: 'absolute',
                    title: '',
                    items: [
                        {
                            xtype: 'numberfield',
                            x: 30,
                            y: 150,
                            formBind: false,
                            id: 'koefEdIzmT',
                            width: 300,
                            fieldLabel: 'коеффициент пересчета',
                            labelWidth: 180,
                            name: 'koef',
                            allowBlank: false,
                            blankText: 'Поле обязательное для заполнения',
                            hideTrigger: true,
                            decimalPrecision: 11
                        },
                        {
                            xtype: 'combobox',
                            x: 30,
                            y: 110,
                            width: 300,
                            fieldLabel: 'Единица измерения',
                            labelWidth: 180,
                            name: 'edizm',
                            displayField: 'edizm',
                            queryMode: 'local',
                            store: 'StEdIzm',
                            valueField: 'koef',
                            listeners: {
                                select: 'onComboboxSelect1'
                            }
                        },
                        {
                            xtype: 'textfield',
                            x: 30,
                            y: 20,
                            formBind: false,
                            width: 300,
                            fieldLabel: 'Номер тепломера',
                            labelWidth: 180,
                            name: 'nomer',
                            allowBlank: false,
                            blankText: 'Поле обязательное для заполнения'
                        },
                        {
                            xtype: 'datefield',
                            x: 30,
                            y: 60,
                            width: 300,
                            fieldLabel: 'дата ввода  в зксплуатацию',
                            labelWidth: 180,
                            name: 'sdate',
                            format: 'd-m-Y',
                            submitFormat: 'Ymd'
                        },
                        {
                            xtype: 'datefield',
                            x: 30,
                            y: 200,
                            width: 300,
                            fieldLabel: 'дата последней поверки ',
                            labelWidth: 180,
                            name: 'pdate',
                            format: 'd-m-Y',
                            submitFormat: 'Ymd'
                        },
                        {
                            xtype: 'numberfield',
                            x: 30,
                            y: 250,
                            formBind: false,
                            width: 300,
                            fieldLabel: 'Первичное показание',
                            labelWidth: 180,
                            name: 'tek',
                            allowBlank: false,
                            blankText: 'Поле обязательное для заполнения',
                            hideTrigger: true,
                            decimalPrecision: 6
                        }
                    ]
                },
                {
                    xtype: 'combobox',
                    x: 85,
                    y: 25,
                    formBind: false,
                    style: 'background-color: #DCDCDC;',
                    width: 270,
                    fieldLabel: 'Модель',
                    labelWidth: 70,
                    name: 'model_id',
                    allowBlank: false,
                    displayField: 'model',
                    queryMode: 'local',
                    store: 'StTmodel',
                    valueField: 'model_id'
                }
            ]
        }
    ],

    onComboboxSelect1: function(combo, record, eOpts) {
        var koefEdIzm = Ext.getCmp('koefEdIzmT');
        var selected = record;
        if (selected) {
            koefEdIzm.setValue(selected.get('koef'));
        }
    }

});