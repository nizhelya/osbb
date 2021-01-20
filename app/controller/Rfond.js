/*
 * File: app/controller/Rfond.js
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

Ext.define('Osbb.controller.Rfond', {
    extend: 'Ext.app.Controller',

    control: {
        "#tabRfond": {
            activate: 'onTabRfondActivate'
        },
        "#btAddNachRfondPrev": {
            click: 'onBtAddNachRfondPrevClick'
        },
        "#btAddNachRfond": {
            click: 'onBtAddNachRfondClick'
        },
        "#btAddPererRfond": {
            click: 'onBtAddPererRfondClick'
        },
        "#grTarifHousesRfond": {
            selectionchange: 'onGrTarifHousesRfondSelectionChange'
        }
    },

    onTabRfondActivate: function(component, eOpts) {
        //STORE
        var form = Ext.getCmp('fmRfond');
        var btAddNach = Ext.getCmp('btAddNachRfond');
        var grid = Ext.getCmp('grTarifHousesRfond');
        var store = grid.getStore();
        store.removeAll();
        var dt = new Date();
        var firstDay = Ext.Date.getFirstDateOfMonth( dt ) ;
        form.getForm().reset();
        form.getForm().findField('data_nach').setValue(firstDay);
        btAddNach.setText("Начислить Р.Фонд за период   "+ Ext.Date.format(firstDay, 'F,Y'));

    },

    onBtAddNachRfondPrevClick: function(button, e, eOpts) {
        var me = this;
        var stUser = Ext.data.StoreManager.get("StUser");
        var grid =  Ext.getCmp('grTarifHousesRfond');
        var getRowSelection = grid.getSelectionModel().getSelection()[0];
        var house_id = getRowSelection.get('house_id');
        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            what:"nachislenie_rfond_prev",
            house_id:house_id
        };


        //LOGIKA

        var myMask= Ext.Msg.show({
            title:'Начисление...',
            msg: 'Начисление услуги.Ожидайте...',
            buttons: Ext.Msg.CANCEL,
            wait: true,
            modal: true,
            icon: Ext.Msg.INFO
        });

        QueryAddress.updateRecords(params,function(results){
            if(results.success==="1"){
                myMask.close();
                Ext.MessageBox.show({
                    title: 'Начисление услуги',
                    msg: results.msg,
                    buttons: Ext.MessageBox.OK,
                    icon: Ext.MessageBox.INFO
                });
            } else {
                myMask.close();
                Ext.MessageBox.show({
                    title: 'Начисление услуги',
                    msg: results.msg,
                    buttons: Ext.MessageBox.OK,
                    icon: Ext.MessageBox.ERROR
                });
            }

        });
    },

    onBtAddNachRfondClick: function(button, e, eOpts) {
        // in use
        var me = this;
        //STORE
        var stUser = Ext.data.StoreManager.get("StUser");
        var grid =  Ext.getCmp('grTarifHousesRfond');

        var getRowSelection = grid.getSelectionModel().getSelection()[0];
        var house_id = getRowSelection.get('house_id');
        //LOGIN & PASSWORD
        var values =stUser.getAt(0);
        var params = {
            login:values.get('login'),
            password:values.get('password'),
            what:"nachislenie_rfond_now",
            house_id:house_id
        };


        //LOGIKA

        var myMask= Ext.Msg.show({
            title:'Начисление...',
            msg: 'Начисление услуги.Ожидайте...',
            buttons: Ext.Msg.CANCEL,
            wait: true,
            modal: true,
            icon: Ext.Msg.INFO
        });

        QueryAddress.updateRecords(params,function(results){
            if(results.success==="1"){
                myMask.close();
                Ext.MessageBox.show({
                    title: 'Начисление услуги',
                    msg: results.msg,
                    buttons: Ext.MessageBox.OK,
                    icon: Ext.MessageBox.INFO
                });
            } else {
                myMask.close();
                Ext.MessageBox.show({
                    title: 'Начисление услуги',
                    msg: results.msg,
                    buttons: Ext.MessageBox.OK,
                    icon: Ext.MessageBox.ERROR
                });
            }

        });
    },

    onBtAddPererRfondClick: function(button, e, eOpts) {
        var value = button.findParentByType('form').getValues();
        var stUser = Ext.data.StoreManager.get("StUser");
        var grid = Ext.getCmp('grTarifHousesRfond');
        //var store = grid.getStore();
        var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection();
        var size = Ext.Object.getSize(gridRowSelectedRecords) ;
        var values =stUser.getAt(0);
        var params =[];
        if (size > 1){
            params = {
                login:values.get('login'),
                password:values.get('password'),
                what:"pereraschet_rfond",
                allkv:value.allkv,
                tarif_manual:0,
                sdata:value.sdata,
                fdata:value.fdata,
                address_ot:value.address_ot,
                address_do:value.address_do,
                info:value.info
            };
        } else {

            params = {
                login:values.get('login'),
                password:values.get('password'),
                what:"pereraschet_rfond",
                allkv:value.allkv,
                tarif_manual:value.tarif_manual,
                rfond:value.rfond,
                ch_rfond:value.ch_rfond,
                sdata:value.sdata,
                fdata:value.fdata,
                address_ot:value.address_ot,
                address_do:value.address_do,
                info:value.info
            };
        }
        var house = "";
        var myMask = Ext.Msg.show({
            title:'Перерасчет по Р.Фонду',
            msg: 'Выполнение перерасчета.Ожидайте...',
            buttons: Ext.Msg.CANCEL,
            wait: true,
            modal: true,
            icon: Ext.Msg.INFO
        });
        Ext.Object.each(gridRowSelectedRecords, function(key, val, myself) {
            Ext.Object.merge(val.data, params);

            QueryAddress.updateRecords(val.data,function(results){
                // console.log(results);

                if(results.success==="1"){
                    myMask.close();

                    Ext.MessageBox.show({
                        title: 'Перерасчет услуги',
                        msg: "Перерасчет услуги выполнен",
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.INFO
                    });
                }  else {
                    house =val.data.house;
                    myMask.close();
                    Ext.MessageBox.show({
                        title: 'Перерасчет услуги ',
                        msg: "Перерасчет не выполнен " ,
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.ERROR
                    });

                }
            });
        });

    },

    onGrTarifHousesRfondSelectionChange: function(model, selected, eOpts) {
        var stAddress = Ext.data.StoreManager.get('StAddressOrg');
        var form = Ext.getCmp('fmRfond');
        var btAddPerer = Ext.getCmp('btAddPererRfond');
        var viborTarif = Ext.getCmp('cbTarifRfond');
        var btAddNach = Ext.getCmp('btAddNachRfond');
        var btAddNachPrev = Ext.getCmp('btAddNachRfondPrev');

        var btnClearNach = Ext.getCmp('btnClearNachRfond');
        var btnInsTarif = Ext.getCmp('btnInsTarifRfond');
        var tarif = Ext.getCmp('tarRfond');

        var dt = new Date();
        var lastDay = Ext.Date.getLastDateOfMonth( dt ) ;
        var firstDay = Ext.Date.getFirstDateOfMonth( dt ) ;

        //console.log(selected,index);
        if (selected.length > 0) {
            form.getForm().loadRecord(selected[0]);

            if (Ext.Date.format(Ext.Date.getFirstDateOfMonth(selected[0].data.data), 'Y-m-d') ==
                Ext.Date.format(Ext.Date.getFirstDateOfMonth(form.getForm().findField('data_nach').getValue()), 'Y-m-d')) {
                btAddNach.setDisabled(false);
                btAddNachPrev.setDisabled(false);

                btnClearNach.setDisabled(false);
                btAddPerer.setDisabled(true);
                btnInsTarif.setDisabled(false);

                form.getForm().findField('sdata').setValue("0");
                form.getForm().findField('fdata').setValue("0");
                form.getForm().findField('rfond').setValue("");
                form.getForm().findField('info').setValue("");
                form.getForm().findField('ch_rfond').setValue("");
                form.getForm().findField('address_ot').clearValue();
                form.getForm().findField('address_do').clearValue();
                form.getForm().findField('allkv').setValue(1);
                viborTarif.clearValue();
                viborTarif.setDisabled(false);



            }else{
                btAddNach.setDisabled(true);
                btnClearNach.setDisabled(true);
                btAddNachPrev.setDisabled(true);
                btAddPerer.setDisabled(false);
                form.getForm().findField('sdata').setValue(Ext.Date.format(Ext.Date.getFirstDateOfMonth(selected[0].data.data), 'Y-m-d'));
                form.getForm().findField('fdata').setValue(Ext.Date.format( Ext.Date.getLastDateOfMonth(selected[0].data.data), 'Y-m-d'));
                form.getForm().findField('address_ot').clearValue();
                form.getForm().findField('address_do').clearValue();
                form.getForm().findField('allkv').setValue(1);
                form.getForm().findField('tarif_manual').setValue(0);
                viborTarif.setDisabled(true);
                btnInsTarif.setDisabled(true);
            }
            tarif.setValue(0);


            stAddress.removeAll();
            stAddress.load({
                params: {
                    what:'AddressFromHousesTarif',
                    house_id: selected[0].data.house_id
                },
                callback: function(records,operation,success){
                    if(success){
                        form.getForm().findField('address_ot').setValue(records[0].get('address_id'));
                        form.getForm().findField('address_do').setValue(records[0].get('address_id'));
                    }

                },
                scope:this
            });

        }

    }

});
