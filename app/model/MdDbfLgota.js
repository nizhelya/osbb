/*
 * File: app/model/MdDbfLgota.js
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

Ext.define('Osbb.model.MdDbfLgota', {
    extend: 'Ext.data.Model',
    alias: 'model.mdDbfLgota',

    requires: [
        'Ext.data.field.String',
        'Ext.data.field.Number',
        'Ext.data.field.Date'
    ],

    idProperty: 'rec_id',

    fields: [
        {
            type: 'int',
            name: 'cdpr'
        },
        {
            type: 'string',
            name: 'idcode'
        },
        {
            type: 'string',
            name: 'fio'
        },
        {
            type: 'string',
            name: 'ppos'
        },
        {
            type: 'string',
            name: 'rs'
        },
        {
            type: 'int',
            name: 'yearin'
        },
        {
            type: 'int',
            name: 'monthin'
        },
        {
            type: 'int',
            name: 'lgcode'
        },
        {
            type: 'string',
            name: 'data1'
        },
        {
            type: 'string',
            name: 'data2'
        },
        {
            type: 'int',
            name: 'lgkol'
        },
        {
            type: 'string',
            name: 'lgkat'
        },
        {
            type: 'int',
            name: 'lgprc'
        },
        {
            type: 'float',
            name: 'summ'
        },
        {
            type: 'float',
            name: 'fact'
        },
        {
            type: 'float',
            name: 'tarif'
        },
        {
            type: 'int',
            name: 'flag'
        },
        {
            type: 'string',
            name: 'house'
        },
        {
            type: 'int',
            name: 'rec_id'
        },
        {
            type: 'string',
            name: 'vibor'
        },
        {
            type: 'int',
            name: 'lgotnik_id'
        },
        {
            type: 'int',
            name: 'house_id'
        },
        {
            type: 'int',
            name: 'address_id'
        },
        {
            type: 'int',
            name: 'osmd_id'
        },
        {
            type: 'int',
            name: 'pr'
        },
        {
            type: 'date',
            name: 'data'
        }
    ]
});