/*
 * File: app/store/StTeploTarif.js
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

Ext.define('Osbb.store.StTeploTarif', {
    extend: 'Ext.data.Store',
    alias: 'store.stTeploTarif',

    requires: [
        'Ext.data.field.String',
        'Ext.data.proxy.Memory'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'stTeploTarif',
            autoLoad: true,
            data: [
                {
                    usluga: 'Отопл за 1Гкал',
                    tarif: 'otoplenie'
                },
                {
                    usluga: 'Отопл за 1м2',
                    tarif: 'aotoplenie'
                },
                {
                    usluga: 'пер_отоп 1м2',
                    tarif: 'ch_aotoplenie'
                },
                {
                    usluga: 'Гкал/м2 льг',
                    tarif: 'gkm2_lg'
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