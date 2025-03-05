import React, { useState } from 'react';
import {
  View,
  StyleSheet,
  Alert,
  Touchable,
  Pressable,
  ImageBackground,
} from 'react-native';
import {
  TextInput,
  Button,
  Text,
  useTheme,
  IconButton,
} from 'react-native-paper';
import { Image } from 'react-native';
import axios from 'axios';
import emailService from '../../service/emailService';
export default function LoginScreen({ navigation }) {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const theme = useTheme();

  const checkAncount = async () => {
    try {
      const res = await axios.post('http://192.168.43.151:5000/new/check', {
        email,
        password,
      });
      // const res = await axios.post('http://127.0.0.1:5000/new/check', {
      //   email,
      //   password,
      // });

      console.log(res.data);

      if (res.data.message === 'Account found') {
        emailService.setEmailGlobal(email);
        navigation.navigate('app');
      } else {
        alert(res.data.message);
      }
    } catch (error) {
      alert('Lỗi rồi: ' + (error.response?.data?.message || error.message));
    }
  };

  const handleRegister = () => {
    checkAncount();
  };

  return (
    <View>
      <View>
        <Image
          source={require('@/assets/images/HH-min.png')}
          style={{
            height: 350,
            width: '100%',
            resizeMode: 'cover',
            borderBottomRightRadius: 20,
            borderBottomLeftRadius: 20,
          }}
        />
      </View>
      <View style={styles.container}>
        <View
          style={{
            flexDirection: 'row',
            justifyContent: 'center',
            alignItems: 'center',
            marginTop: 30,
          }}
        >
          <Button>Đăng nhập</Button>
          <IconButton icon="medical-bag" size={40} iconColor="blue" />
        </View>
        <TextInput
          label="Email"
          value={email}
          onChangeText={setEmail}
          keyboardType="email-address"
          style={styles.input}
          mode="outlined"
        />
        <TextInput
          label="Password"
          value={password}
          onChangeText={setPassword}
          secureTextEntry
          style={styles.input}
          mode="outlined"
        />
        <View
          style={{
            flexDirection: 'row',
            justifyContent: 'space-between',
            alignItems: 'center',
          }}
        >
          <Text style={{ marginLeft: 5 }}>Chưa có tài khoản ?</Text>
          {/* <IconButton
            icon="medical-bag"
            size={40}
            iconColor="blue"
            style={{ marginRight: 0 }}
          /> */}
          <Pressable
            onPress={() => {
              navigation.navigate('register');
            }}
          >
            <Text style={{ color: 'red' }}>Đăng kí</Text>
          </Pressable>
        </View>
        <Button
          mode="contained"
          onPress={handleRegister}
          style={styles.button}
          labelStyle={styles.buttonText}
        >
          Đăng nhập
        </Button>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    // flex: 1,
    // justifyContent: 'center',
    padding: 15,
    backgroundColor: '#f7f7f7',
  },
  input: {
    marginBottom: 15,
    backgroundColor: 'white',
    fontSize: 14,
    borderRadius: 20,
  },
  button: {
    marginTop: 20,
    padding: 10,
    borderRadius: 5,
    backgroundColor: '#007bff',
  },
  buttonText: {
    fontSize: 16,
    color: '#fff',
  },
});
