/*
 * File: app/store/StFamaly.js
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

Ext.define('Osbb.store.StFamaly', {
    extend: 'Ext.data.Store',
    alias: 'store.stFamaly',

    requires: [
        'Osbb.model.MdAppartment',
        'Ext.data.proxy.Direct',
        'Osbb.DirectAPI',
        'Ext.data.reader.Json',
        'Ext.data.writer.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StFamaly',
            model: 'Osbb.model.MdAppartment',
            proxy: {
                type: 'direct',
                directFn: 'QueryAddress.getResults',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                },
                writer: {
                    type: 'json',
                    writeAllFields: true
                }
            }
        }, cfg)]);
    }
});