<template>
    <scroll-view :content-container-style="{contentContainer: {
        paddingVertical: 20
    }}">
        <view class="page">
            <view class="header">
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
                      v-if="foodUser['Type'] == 1"
                      :style="{margin: 30}"
                      :on-press="() => {
                        navigation.navigate('User', {
                                        user: navigation.getParam('user')
                                    })
                      }"
                      color="#841994"
                      title="Add Users" />
                <button 
                      v-if="foodUser['Type'] == 1"
                      class="link-text"
                      :on-press="() => {
                        navigation.navigate('Food', {
                                        user: navigation.getParam('user')
                                    })
                      }"
                      color="#898994"
                      title="Add Foods" />
                <button 
                      v-if="foodUser['Type'] == 1"
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
            <view  class="header">
                <view class="input-field">
                  <text class="login-label">Food Name</text>
                    <text-input
                        v-model="foodName"
                        class="input"
                      />
                </view>
                <view class="input-field">
                  <text class="login-label">Order From</text>
                    <text-input
                        v-model="foodUser['Username']"
                        class="input"
                      />
                </view>
                <view class="input-field">
                    <text class="login-label">Food Description</text>
                    <text-input
                        v-model="foodAbout"
                        class="input"
                      />
                </view>
                <view class="input-field">
                    <text class="login-label">Enter Number On Table</text>
                    <text-input
                        v-model="foodTableNumber"
                        class="input"
                      />
                </view>
                <button
                        :on-press="placeOrder"
                        :title="orderName"
                        class="btn-primary"
                    />
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
    name: 'History',
    props: {
        navigation: {
          type: Object
        }
      },
    data: function() {
        return {
            showLinks: false,
            loginText: 'Enter Food Details',
            text: '',
            orderName: 'Place Order for food',
            foodName: this.navigation.getParam('foodName'),
            foodUser: this.navigation.getParam('user'),
            foodId: this.navigation.getParam('foodId'),
            foodAbout: '',
            foodTableNumber: '',
        };
    },
    mounted(){
      this.logut();
    },
     methods: {
       logut: function(){
                if (!this.navigation.getParam('user')) {
                    this.navigation.navigate('Login')
                }
            },
        placeOrder: function() {
            this.orderName = 'Placing order Please wait........'
            var foodUser = this.foodUser['Username'];
            var foodId = this.foodId;
            var foodAbout = this.foodAbout;
            var foodTableNumber = this.foodTableNumber;

            var details = {
                'foodUser': foodUser,
                'foodId': foodId,
                'foodAbout': foodAbout,
                'foodTableNumber': foodTableNumber,
               }


            let axiosConfig = {
                  headers: {
                      'Content-Type': 'application/json;charset=UTF-8',
                      "Access-Control-Allow-Origin": "*",
                  }
                };

              axios.post('http://192.168.42.189:8000/api/orderFood', details, axiosConfig)  
                  .then((res) => {
                      console.log(res.data);
                      this.orderName = 'Success';
                      // if (res.data.success) {
                      //     this.Username = '';
                      //     this.Password = '';
                      //     this.loginName = res.data.msg;
                      //     if (res.data['User']['Type'] === 2) {
                      //         var Url = 'Home';
                      //     }else{
                      //         var Url = 'Home'
                      //     }

                      //     this.navigation.navigate(Url, {
                      //                 user: res.data['User']
                      //             });
                      // }else{
                      //      this.loginName = res.data.msg;   
                      // }
                  })   
                  .catch((err) => {
                      console.log(err);
                      this.orderName = "Error!!!";
                  })
        }
    }
}
</script>

<style type="text/css">
    .page {
        top: 30px;
        width: 100%;
        height: 1000px;
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
    .col-right{
      width: 10%;
    }

    .logo{
      fontSize: 30px;
    }


    .login-text{
        color: #000000;
        fontSize: 16;
        fontWeight: bold;
        bottom: 20px;
    }
    .form {
        marginLeft: 30;
        marginRight: 30;
        flexGrow: 2;
        width: 350px;
    }

    .logo {
        marginBottom: 12;
        height: 90;
        fontWeight: bold;
    }

    .header {
        fontSize: 25;
        marginBottom: 70;
        textAlign: center;
        color: #D51A1A;
    }

    .input-field {
        marginBottom: 25;
        width: 350px;
    }

    .input {
        fontSize: 18;
        color: black;
        borderWidth: 1;
        width: 350px;
        height: 40px;
        borderRadius: 5px;
        shadowColor: 20px;
    }

    .input-field .input {
        fontSize: 54;
    }

    .btn-primary {
        height: 50px;
        margin: 30 5 15 5;
        backgroundColor: #D51A1A;
        borderRadius: 5;
        fontSize: 20;
        fontWeight: bold;
    }

    .login-label {
        color: #A8A8A8;
        fontSize: 16;
    }

    .sign-up-label {
        marginBottom: 20;
    }

    .bold {
        color: #000000;
    }
</style>