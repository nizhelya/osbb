/*
 * File: app/model/MdTemperature.js
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

Ext.define('Osbb.model.MdTemperature', {
    extend: 'Ext.data.Model',
    alias: 'model.mdTemperature',

    requires: [
        'Ext.data.field.Date',
        'Ext.data.field.Number',
        'Ext.data.field.String',
        'Ext.data.field.Boolean'
    ],

    idProperty: 'rec_id',

    fields: [
        {
            type: 'int',
            name: 'rec_id'
        },
        {
            type: 'date',
            name: 'data',
            dateWriteFormat: 'Ymd'
        },
        {
            type: 'int',
            name: 'god'
        },
        {
            type: 'float',
            name: 'temp'
        },
        {
            type: 'int',
            name: 'kalendar_hour'
        },
        {
            type: 'int',
            name: 'grafik_hour'
        },
        {
            type: 'int',
            name: 'work_day'
        },
        {
            type: 'string',
            name: 'what'
        },
        {
            type: 'boolean',
            name: 'otoplenie'
        },
        {
            type: 'int',
            name: 'day_ot'
        },
        {
            type: 'int',
            name: 'day_gv'
        }
    ]
});