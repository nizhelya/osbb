/*
 * File: app/view/sprav/WinAddVodomer.js
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

Ext.define('Osbb.view.sprav.WinAddVodomer', {
    extend: 'Ext.window.Window',
    alias: 'widget.winaddvodomer',

    requires: [
        'Osbb.view.sprav.WinAddVodomerViewModel',
        'Osbb.view.sprav.WinAddVodomerViewController',
        'Ext.form.Panel',
        'Ext.form.field.Hidden',
        'Ext.form.field.ComboBox',
        'Ext.button.Button',
        'Ext.form.FieldSet',
        'Ext.form.field.Number',
        'Ext.form.field.Date',
        'Ext.form.RadioGroup',
        'Ext.form.field.Radio'
    ],

    controller: 'winaddvodomer',
    viewModel: {
        type: 'winaddvodomer'
    },
    height: 675,
    id: 'winAddVodomer',
    width: 554,
    layout: 'fit',
    title: 'Ввод нового счетчика воды',
    modal: true,
    defaultListenerScope: true,

    items: [
        {
            xtype: 'form',
            height: 560,
            id: 'fmAddVodomer',
            width: 530,
            layout: 'absolute',
            title: '',
            items: [
                {
                    xtype: 'hiddenfield',
                    x: 0,
                    y: 0,
                    fieldLabel: 'Label',
                    name: 'what'
                },
                {
                    xtype: 'hiddenfield',
                    x: 0,
                    y: 0,
                    fieldLabel: 'Label',
                    name: 'vodomer_id'
                },
                {
                    xtype: 'checkboxfield',
                    x: 240,
                    y: 30,
                    id: 'chkExistentVod',
                    style: 'background-color: #DCDCDC;',
                    fieldLabel: '',
                    hideEmptyLabel: false,
                    labelWidth: 20,
                    name: 'isjoint',
                    submitValue: false,
                    validateOnChange: false,
                    boxLabel: 'Подключить существующий счетчик',
                    inputValue: '1',
                    uncheckedValue: '0',
                    listeners: {
                        change: 'onChkExistentVodChange'
                    }
                },
                {
                    xtype: 'combobox',
                    x: 240,
                    y: 65,
                    hidden: true,
                    id: 'cbExistentVod',
                    width: 250,
                    fieldLabel: 'Номер',
                    labelWidth: 60,
                    name: 'joint_id',
                    displayField: 'nomer',
                    store: 'StExistentVod',
                    valueField: 'vodomer_id',
                    listeners: {
                        select: {
                            fn: 'onCbExistentVodSelect',
                            scope: 'controller'
                        }
                    }
                },
                {
                    xtype: 'button',
                    x: 335,
                    y: 590,
                    formBind: true,
                    id: 'btAddVodomer',
                    width: 185,
                    icon: 'resources/css/images/ico/add.png',
                    text: 'Добавить счетчик'
                },
                {
                    xtype: 'button',
                    handler: function(button, event) {
                        button.up('#winAddVodomer').close();
                    },
                    x: 30,
                    y: 590,
                    width: 80,
                    icon: 'resources/css/images/ico/delete.png',
                    text: 'Отмена'
                },
                {
                    xtype: 'fieldset',
                    x: 25,
                    y: 90,
                    height: 480,
                    id: 'fcntNewVodomer',
                    style: 'background-color: #DCDCDC;',
                    width: 500,
                    layout: 'absolute',
                    title: '',
                    items: [
                        {
                            xtype: 'numberfield',
                            x: 275,
                            y: 410,
                            width: 145,
                            fieldLabel: 'Первичное показание',
                            labelAlign: 'top',
                            labelWidth: 150,
                            name: 'tek',
                            value: 0,
                            allowBlank: false,
                            blankText: 'Поле обязательное для заполнения',
                            hideTrigger: true,
                            validateBlank: true,
                            decimalPrecision: 0,
                            minValue: 0
                        },
                        {
                            xtype: 'datefield',
                            x: 275,
                            y: 300,
                            width: 145,
                            fieldLabel: 'дата ввода ',
                            labelAlign: 'top',
                            labelWidth: 150,
                            name: 'sdate',
                            allowBlank: false,
                            format: 'd-m-Y',
                            submitFormat: 'Ymd'
                        },
                        {
                            xtype: 'datefield',
                            x: 65,
                            y: 300,
                            width: 140,
                            fieldLabel: 'дата поверки ',
                            labelAlign: 'top',
                            labelWidth: 150,
                            name: 'pdate',
                            format: 'd-m-Y',
                            submitFormat: 'Ymd'
                        },
                        {
                            xtype: 'datefield',
                            x: 65,
                            y: 355,
                            width: 135,
                            fieldLabel: 'Следующая поверка ',
                            labelAlign: 'top',
                            labelWidth: 150,
                            name: 'fpdate',
                            format: 'd-m-Y',
                            submitFormat: 'Ymd'
                        },
                        {
                            xtype: 'radiogroup',
                            x: 65,
                            y: 215,
                            id: 'rbgPosition',
                            style: 'background-color: #F1EEEE ;',
                            width: 135,
                            fieldLabel: 'Установлен',
                            labelAlign: 'top',
                            columns: 1,
                            items: [
                                {
                                    xtype: 'radiofield',
                                    name: 'position',
                                    boxLabel: 'Горизонтально',
                                    checked: true,
                                    inputValue: 'гориз'
                                },
                                {
                                    xtype: 'radiofield',
                                    name: 'position',
                                    boxLabel: 'Вертикально',
                                    inputValue: 'верт'
                                }
                            ]
                        },
                        {
                            xtype: 'checkboxfield',
                            x: 65,
                            y: 85,
                            fieldLabel: '',
                            name: 'vd',
                            boxLabel: 'Вода',
                            checked: true,
                            inputValue: '1',
                            uncheckedValue: '0'
                        },
                        {
                            xtype: 'checkboxfield',
                            x: 140,
                            y: 85,
                            fieldLabel: '',
                            name: 'st',
                            boxLabel: 'Стоки',
                            checked: true,
                            inputValue: '1',
                            uncheckedValue: '0'
                        },
                        {
                            xtype: 'checkboxfield',
                            x: 340,
                            y: 35,
                            id: 'jointVodomer',
                            fieldLabel: '',
                            name: 'joint',
                            boxLabel: 'Общий',
                            inputValue: '1',
                            uncheckedValue: '0'
                        },
                        {
                            xtype: 'radiogroup',
                            x: 275,
                            y: 90,
                            height: 200,
                            id: 'rbgPlace',
                            style: 'background-color: #F1EEEE ;',
                            width: 130,
                            fieldLabel: 'Место установки',
                            labelAlign: 'top',
                            columns: 1,
                            items: [
                                {
                                    xtype: 'radiofield',
                                    labelWidth: 80,
                                    name: 'place',
                                    boxLabel: 'Кухня',
                                    checked: true,
                                    inputValue: 'кухня'
                                },
                                {
                                    xtype: 'radiofield',
                                    name: 'place',
                                    boxLabel: 'Санузел',
                                    inputValue: 'санузел'
                                },
                                {
                                    xtype: 'radiofield',
                                    name: 'place',
                                    boxLabel: 'Колодец',
                                    inputValue: 'Колодец'
                                },
                                {
                                    xtype: 'radiofield',
                                    name: 'place',
                                    boxLabel: 'ПРУ',
                                    inputValue: 'ПРУ'
                                },
                                {
                                    xtype: 'radiofield',
                                    name: 'place',
                                    boxLabel: 'МусКам',
                                    inputValue: 'МусКам'
                                },
                                {
                                    xtype: 'radiofield',
                                    name: 'place',
                                    boxLabel: 'Полив',
                                    inputValue: 'Полив'
                                },
                                {
                                    xtype: 'radiofield',
                                    name: 'place',
                                    boxLabel: 'Другое',
                                    inputValue: 'Другое'
                                }
                            ]
                        },
                        {
                            xtype: 'radiogroup',
                            x: 65,
                            y: 125,
                            id: 'rbgTypeVoda',
                            style: 'background-color: #F1EEEE ;',
                            width: 135,
                            fieldLabel: 'Тип  воды',
                            labelAlign: 'top',
                            columns: 1,
                            vertical: true,
                            items: [
                                {
                                    xtype: 'radiofield',
                                    name: 'voda',
                                    boxLabel: 'На холодную',
                                    checked: true,
                                    inputValue: 'Хвода'
                                },
                                {
                                    xtype: 'radiofield',
                                    name: 'voda',
                                    boxLabel: 'На горячую',
                                    inputValue: 'Гвода'
                                }
                            ]
                        },
                        {
                            xtype: 'textfield',
                            x: 55,
                            y: 15,
                            formBind: false,
                            width: 250,
                            fieldLabel: 'Номер',
                            labelWidth: 60,
                            name: 'nomer',
                            allowBlank: false,
                            blankText: 'Поле обязательное для заполнения'
                        },
                        {
                            xtype: 'combobox',
                            x: 55,
                            y: 50,
                            formBind: false,
                            id: 'cbVodModel',
                            width: 250,
                            fieldLabel: 'Модель',
                            labelWidth: 60,
                            name: 'model_id',
                            allowBlank: false,
                            displayField: 'model',
                            queryMode: 'local',
                            store: 'StVmodel',
                            valueField: 'model_id'
                        },
                        {
                            xtype: 'textfield',
                            x: 65,
                            y: 410,
                            width: 140,
                            fieldLabel: '№ пломбы',
                            labelAlign: 'top',
                            name: 'plomba'
                        },
                        {
                            xtype: 'textfield',
                            x: 275,
                            y: 355,
                            width: 145,
                            fieldLabel: '№ заводской пломбы',
                            labelAlign: 'top',
                            name: 'zplomba'
                        }
                    ]
                },
                {
                    xtype: 'textfield',
                    x: 30,
                    y: 15,
                    style: 'background-color: #DCDCDC;',
                    width: 200,
                    fieldLabel: 'текущий адрес_ид',
                    labelWidth: 130,
                    name: 'address_id'
                },
                {
                    xtype: 'textfield',
                    x: 30,
                    y: 45,
                    style: 'background-color: #DCDCDC;',
                    width: 200,
                    fieldLabel: 'новый адрес_ид',
                    labelWidth: 130,
                    name: 'new_address_id',
                    allowBlank: false
                },
                {
                    xtype: 'hiddenfield',
                    fieldLabel: 'Label',
                    name: 'dvodomer_id'
                }
            ]
        }
    ],

    onChkExistentVodChange: function(field, newValue, oldValue, eOpts) {
        var cnt = Ext.getCmp('fcntNewVodomer');
        var cb = Ext.getCmp('cbExistentVod');
        var form = field.findParentByType('form');


        if (newValue) {
            cnt.hide();
            cb.show();
            cb.clearValue();

            form.down('#btAddVodomer').setDisabled(true);

        }
        else {
            cnt.show();
            cb.hide();
            form.down('#btAddVodomer').setDisabled(false);

        }
    }

});