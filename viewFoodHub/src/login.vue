<template>
    <scroll-view :content-container-style="{contentContainer: {
        paddingVertical: 20
    }}">
        <view  class="page">
          <text class="login-text">{{loginText}}</text>
            <view  class="header">
                <view class="input-field">
                    <text class="login-label">Enter Username</text>
                    <text-input
                        v-model="loginUsername"
                        class="input"
                      />
                </view>
                <view class="input-field">
                    <text class="login-label">Enter password</text>
                    <text-input
                        v-model="loginPassword"
                        class="input"
                      />
                </view>
                  <button
                        :on-press="loginUsers"
                        :title="loginName"
                        class="btn-primary"
                    />
            </view>
        </view>
    </scroll-view>
</template>
<script>
    import { Dimensions } from 'react-native';
    import axios from 'axios';
    export default {
        name: 'LoginScreen',
        props: {
            navigation: {
              type: Object
            }
          },
        data: function() {
            return {
                loginText: 'Enter your credentials to login',
                text: '',
                loginUsername: '',
                loginPassword: '',
                loginName: 'Login',
            };
        },
         methods: {
            // onPressLearnMore: function() {
            //     this.navigation.navigate("Home");
            // }
             loginUsers: function() {
                // this.navigation.navigate("Home");
                var Username = this.loginUsername;
                var Password = this.loginPassword;
                this.loginName = 'Logging In. Please Wait'
                var details = {
                        'Username': Username,
                        'Password': Password,
                    }
                let axiosConfig = {
                  headers: {
                      'Content-Type': 'application/json;charset=UTF-8',
                      "Access-Control-Allow-Origin": "*",
                  }
                };
                axios.post('http://192.168.42.189:8000/api/loginUser', details, axiosConfig)  
                    .then((res) => {
                        console.log(res.data);
                        this.loginName = 'Success';
                        if (res.data.success) {
                            this.Username = '';
                            this.Password = '';
                            this.loginName = res.data.msg;
                            if (res.data['User']['Type'] === 2) {
                                var Url = 'Home';
                            }else{
                                var Url = 'Home'
                            }

                            this.navigation.navigate(Url, {
                                        user: res.data['User']
                                    });
                        }else{
                             this.loginName = res.data.msg;   
                        }
                    })   
                    .catch((err) => {
                        console.log(err);
                        this.loginName = "Error!!!";
                    })
            }
        }
    }
</script>




<style type="text/css">
    .page {
        top: 180px;
        height: 700px;
        alignItems: center;
        flexDirection: column;
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
        width: 300px;
    }

    .input {
        fontSize: 18;
        color: black;
        borderWidth: 1;
        width: 300px;
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