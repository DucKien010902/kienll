import React from 'react';

import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import HomeScreen from './index';
import TabTwoScreen from './explore';
import RegisterScreen from './register';
import LoginScreen from './login';
import UserProfileScreen from './user';
import Ionicons from '@expo/vector-icons/Ionicons';
import MaterialIcons from '@expo/vector-icons/MaterialIcons';

const Stack = createStackNavigator();
const Tab = createBottomTabNavigator();

function InHomeScreen() {
  return (
    <Stack.Navigator
      screenOptions={{
        headerShown: false, // Tắt tất cả các header cho tất cả các màn hình trong Stack.Navigator
        animation: 'none',
      }}
    >
      <Stack.Screen name="index" component={HomeScreen}></Stack.Screen>
      <Stack.Screen name="user" component={UserProfileScreen}></Stack.Screen>
    </Stack.Navigator>
  );
}

function TabLayout() {
  return (
    <Tab.Navigator
      screenOptions={{
        headerShown: false, // Tắt header mặc định của Bottom Tabs
      }}
    >
      <Tab.Screen
        name="Trang chủ"
        component={InHomeScreen}
        options={{
          tabBarIcon: ({ color, size }) => (
            <Ionicons name="home" size={size} color={color} /> // Icon cho tab "Index"
          ),
        }}
      />
      <Tab.Screen
        name="Khám phá"
        component={TabTwoScreen}
        options={{
          tabBarIcon: ({ color, size }) => (
            <MaterialIcons name="explore" size={size} color={color} />
          ),
        }}
      />
      <Tab.Screen
        name="Thông báo"
        component={TabTwoScreen}
        options={{
          tabBarIcon: ({ color, size }) => (
            <Ionicons name="notifications" size={size} color={color} />
          ),
        }}
      />
      <Tab.Screen
        name="Cá nhân"
        component={TabTwoScreen}
        options={{
          tabBarIcon: ({ color, size }) => (
            <Ionicons name="people-circle-outline" size={size} color={color} />
          ),
        }}
      />
    </Tab.Navigator>
  );
}
export default function App() {
  return (
    <NavigationContainer>
      <Stack.Navigator
        initialRouteName="login"
        screenOptions={{
          headerLeft: () => null, // Tắt tất cả các nút quay lại
          headerShown: false,
          animation: 'none',
        }}
      >
        {/* <Stack.Screen name='index' component={HomeScreen}/> */}
        <Stack.Screen name="login" component={LoginScreen} />
        <Stack.Screen
          name="register"
          component={RegisterScreen}
          // options={{
          //   headerLeft: undefined, // Sử dụng mũi tên quay lại mặc định
          // }}
        />
        <Stack.Screen name="app" component={TabLayout} />
        {/* <Stack.Screen name='explore' component={TabTwoScreen}/> */}
      </Stack.Navigator>
    </NavigationContainer>
  );
}
