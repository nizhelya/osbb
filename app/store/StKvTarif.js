/*
 * File: app/store/StKvTarif.js
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

Ext.define('Osbb.store.StKvTarif', {
    extend: 'Ext.data.Store',
    alias: 'store.stKvTarif',

    requires: [
        'Ext.data.field.String',
        'Ext.data.proxy.Memory'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'stKvTarif',
            autoLoad: true,
            data: [
                {
                    usluga: 'Кв',
                    tarif: 'kv'
                },
                {
                    usluga: 'Кв(1эт)',
                    tarif: 'kvf1'
                },
                {
                    usluga: 'пер Кв',
                    tarif: 'ch_kv'
                },
                {
                    usluga: 'пер Кв(1эт)',
                    tarif: 'ch_kvf1'
                },
                {
                    usluga: 'Доп',
                    tarif: 'dop'
                },
                {
                    usluga: 'ремонт',
                    tarif: 'remont'
                },
                {
                    usluga: 'тар льг(1эт)',
                    tarif: 'lgf1'
                },
                {
                    usluga: 'тар льг',
                    tarif: 'lg'
                }
            ],
            fields: [
                {
                    type: 'string',
                    name: 'usluga'
                },
                {
                    type: 'string',
                    name: 'tarif'
                }
            ],
            proxy: {
                type: 'memory'
            }
        }, cfg)]);
    }
});