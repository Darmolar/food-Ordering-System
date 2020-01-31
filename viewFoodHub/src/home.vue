<template>
    <scroll-view :content-container-style="{contentContainer: {
        paddingVertical: 20,
    }}">    
        <view  class="container">
            <view class="header">
              <view class="nav">
                <view class="col-left">
                  <text class="logo">Logo</text>
                </view>
                <view class="col-right">
                  <button class="logo" title="||||" :on-press="()=>{showLinks = true ? showLinks == false : true}" />
                  <!-- <text class="logo" >||||</text> -->
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
             <view>
               <text class="header-text">Available Foods</text>
             </view>
             <view  class="card" v-for="(foodlists, index) in foodList">
                <view class="card-body">
                    <image
                      class="card-img"
                      :source="require('../assets/food3.jpg')"
                    />
                    <view class="card-text">
                        <text class="h4">{{foodlists['FoodName']}}</text>
                        <text class="h6">{{foodlists['FoodDescription']}}</text>
                    </view>
                    <button
                            :on-press="function(){
                              navigation.navigate('History',{
                                'foodName': foodlists['FoodName'],
                                'foodId':foodlists['foodId'],
                                'user': navigation.getParam('user'),
                              })
                            }"
                            title="Click to Order"
                            class="btn-primary"
                        />
                </view>
            </view>
        </view>
    </scroll-view>
</template>
<script>
import { Alert } from 'react-native';
import { DrawerItems } from 'react-navigation-drawer';
import axios from 'axios';
export default {
    name: 'HomeScreen',
    props: {
        navigation: {
          type: Object
        }
      },
    data: function() {
        return {
            text: 'Dashboard',
            user : this.navigation.getParam('user'),
            foodList: [],
            showLinks: false,
        };
    },
    mounted(){
      this.getFoods();
    },
    methods: {
      getFoods: function(){
                axios.get('http://192.168.42.189:8000/api/getFoods')  
                    .then((res) => {
                        this.foodList = res.data;
                        console.log(this.foodList);
                        // if (!res.data) {
                        //   alert('An error!!');
                        // }
                    })   
                    .catch((err) => {
                        console.log(err);
                    })
      },
      placeOrder: function(id){
        alert(id);
      }
    }
}
</script>

<style type="text/css">
    .container{
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
    .header-text{
      display: flex;
      alignContent: center; 
      justifyContent: center;
      margin: 0;
      fontSize: 20px;
    }

    .card {
          position: relative;
          display: flex;
          minWidth: 0;
          writingDirection: auto;
          borderWidth: .3;
          borderStyle: solid;
          borderTopLeftRadius: 15;
          borderTopRightRadius: 15;
          marginBottom: 20;
        }
    .card-img {
          width: 100%;
          height: 200px;
          borderRadius: 0;
          borderTopLeftRadius: 15;
          borderTopRightRadius: 15;
        }    
    .card-title {
          marginBottom: 1;
        }    
     .card-text {
          backgroundColor: #ffffff;
          marginBottom: 0;
          padding: 20;
          alignContent: center;
        }
      .h4{
        fontSize: 20;
        fontWeight: bold;
      }

      .h6{
        top: 10;
        fontSize: 15;
      } 
</style>