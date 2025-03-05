import React, { useState } from 'react';
import { View, StyleSheet, Alert } from 'react-native';
import { TextInput, Button, Text, useTheme } from 'react-native-paper';
import { Image } from 'react-native';
import axios from 'axios';

export default function RegisterScreen({ navigation }) {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const theme = useTheme();
  const creatAncount = async () => {
    try {
      const res = await axios.post('http://192.168.43.151:5000/new/creat', {
        email,
        password,
      });
      // const res = await axios.post('http://127.0.0.1:5000/new/creat', {
      //   email,
      //   password,
      // });

      console.log(res.data); // In kết quả response nếu cần
      alert('Tạo tài khoản thành công!');
    } catch (error) {
      alert('Lỗi rồi: ' + (error.response?.data?.message || error.message));
    }
  };
  const handleRegister = () => {
    if (password !== confirmPassword) {
      Alert.alert('Error', 'Passwords do not match');
      return;
    } else {
      creatAncount();
      navigation.navigate('login');
    }
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
            borderBottomRightRadius: 30,
            borderBottomLeftRadius: 30,
          }}
        />
      </View>
      <View style={styles.container}>
        <View
          style={{
            flexDirection: 'row',
            justifyContent: 'space-evenly',
            marginTop: 30,
          }}
        >
          <Button>Đăng kí</Button>
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
          label="Mật khẩu"
          value={password}
          onChangeText={setPassword}
          secureTextEntry
          style={styles.input}
          mode="outlined"
        />
        <TextInput
          label="Nhập lại mật khẩu"
          value={confirmPassword}
          onChangeText={setConfirmPassword}
          secureTextEntry
          style={styles.input}
          mode="outlined"
        />
        <Button
          mode="contained"
          onPress={handleRegister}
          style={styles.button}
          labelStyle={styles.buttonText}
        >
          Đăng kí
        </Button>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    // flex: 1,
    // justifyContent: 'center',
    padding: 20,
    backgroundColor: '#f7f7f7',
  },
  title: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 20,
    textAlign: 'center',
    color: '#333',
  },
  input: {
    marginBottom: 15,
    fontSize: 14,
    backgroundColor: 'white',
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
