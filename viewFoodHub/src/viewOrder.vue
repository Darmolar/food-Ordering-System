<template>
    <scroll-view :content-container-style="{contentContainer: {
        paddingVertical: 20
    }}">


<view class="header">
         <view class="page">
            <view>
             <view class="nav">
                <view class="col-left">
                  <text class="logo">Logo</text>
                </view>
                <view class="col-right">
                  <button title="||||" :on-press="()=>{showLinks = true ? showLinks == false : true}" />
                </view>
              </view>
              <view class="view-links" v-if="showLinks">
                <button 
                      :style="{margin: 30}"
                      :on-press="() => {
                        navigation.navigate('Home', {
                                        user: navigation.getParam('user')
                                    })
                      }"
                      color="#841345"
                      title="Home" />
                <button 
                      v-if="user['Type'] == 1"
                      :style="{margin: 30}"
                      :on-press="() => {
                        navigation.navigate('User', {
                                        user: navigation.getParam('user')
                                    })
                      }"
                      color="#841994"
                      title="Add Users" />
                <button 
                      v-if="user['Type'] == 1"
                      class="link-text"
                      :on-press="() => {
                        navigation.navigate('Food', {
                                        user: navigation.getParam('user')
                                    })
                      }"
                      color="#898994"
                      title="Add Foods" />
                <button 
                      v-if="user['Type'] == 1"
                      :on-press="() => {
                        navigation.navigate('ViewOrder')
                      }"
                      class="link-text"
                       color="#887894"
                      title="View Orders" />  
                <button 
                      :on-press="() => {
                        navigation.navigate('Login')
                      }"
                      class="link-text"
                      color="#456894"
                      title="LogOut" />  
              </view>
            </view>
            <view class="table">
              <text class="orderText">All Food Requested</text>
               <view class="table-head">
                 <text class="col">S/N</text>
                 <text class="col">Food</text>
                 <text class="col">Table</text>
                 <text class="col">Description</text>
               </view>

               <view class="table-head" v-for="(orders, index) in orderList">
                 <text class="col-body">{{index+1}}</text>
                 <text class="col-body">{{orders['foodId']}}</text>
                 <text class="col-body">{{orders['foodTableNumber']}}</text>
                 <text class="col-body">{{orders['foodAbout']}}</text>
               </view>
            </view>
        </view>
    </scroll-view>
</template>
<script>
import React from 'react';
import { Dimensions } from 'react-native';
import {Text} from 'react-native';
import axios from 'axios';
export default {
    name: 'ViewOrder',
    props: {
        navigation: {
          type: Object
        }
      },
    data: function() {
        return {
          user: this.navigation.getParam('user'),
           showLinks: false,
           orderList: [],
        };
    },
    mounted(){
      this.getOrders();
    },
    methods: {
       logut: function(){
                if (!this.navigation.getParam('user')) {
                    this.navigation.navigate('Login')
                }
            },
       getOrders: function(){
           axios.get('http://192.168.42.189:8000/api/getOrders')  
                .then((res) => {
                    this.orderList = res.data;
                    // console.log(res.data);
                })   
                .catch((err) => {
                    console.log(err);
                })
       }
    }
}
</script>

<style type="text/css">
    .page {
       top: 20px;
        width: 100%;
        height: 700px;
        padding: 10;
        backgroundColor: #ffffff;
    }

    .nav{
        width: 100%;
        height: 50px;
        display: flex;
        flexDirection: row;
        borderWidth: .7;
        padding: 2px;
    }
    .col-left{
      width: 90%;
    }
    .table{
      padding: 10px;
    }
    .logo{
      fontSize: 30px;
    }
    .table-head{
      display: flex;
      flexDirection: row;
    }
    .col{
      width: 25%;
      height: 30px;
      borderWidth: 1px;
      padding: 5px;
    }

    .col-body{
      width: 25%;
      borderWidth: .4px;
      padding: 5px;
    }
</style>