<template>
  <app-navigator></app-navigator>
</template>

<script>
import {
  createAppContainer,
  createStackNavigator,
  createDrawerNavigator
} from "vue-native-router";
import LoginScreen from "./src/login.vue";
import HomeScreen from "./src/home.vue";
import AddUser from "./src/addUser"
import AddFood from "./src/addFood";
import History from "./src/history" 
import ViewOrder from "./src/viewOrder"



// const DrawerNavigator = createDrawerNavigator(
//   {
//     Login: {
//            screen :LoginScreen,
//            navigationOptions:{
//               drawerLockMode: 'locked-closed',
//                title: 'Log',
//               header: null
//            }
//          },
//     Home: {
//       screen :HomeScreen,
//         navigationOptions:{
//               title: 'Dashboard',
//            }
//       },
    
//   },
//   {
//     initialRouteName: 'Login',
//     drawerBackgroundColor: '#ffffff',
//     minSwipeDistance: 20,
//   }
// );


const StackNavigator = createStackNavigator(
  {
     Login: {
      screen: LoginScreen,
      navigationOptions: ({ navigation }) => ({
        // title: `${navigation.state.params.name}'s Profile'`,
        title: 'Login',
      }),
    },
    Home: {
      screen: HomeScreen,
      navigationOptions: ({ navigation }) => ({
          // title: `${navigation.state.params.name}'s Profile'`,
          title: 'Dashboard',
        }),
    },
    Food: {
      screen: AddFood,
      navigationOptions: ({ navigation }) => ({
          // title: `${navigation.state.params.name}'s Profile'`,
          title: 'Add Foods',
        }),
    },
    User: {
      screen: AddUser,
      navigationOptions: ({ navigation }) => ({
          // title: `${navigation.state.params.name}'s Profile'`,
          title: 'Add Users',
        }),
    },
    History: {
      screen: History,
      navigationOptions: ({ navigation }) => ({
          // title: `${navigation.state.params.name}'s Profile'`,
          title: 'Place Order',
        }),
    },
    ViewOrder: {
      screen: ViewOrder,
      navigationOptions: ({ navigation }) => ({
          // title: `${navigation.state.params.name}'s Profile'`,
          title: 'All Order',
        }),
    }
  },
  {
     initialRouteName: 'Login',
     headerMode: 'none'
  }
);

const AppNavigator = createAppContainer(StackNavigator);

export default {
  components: { AppNavigator },
}
</script>