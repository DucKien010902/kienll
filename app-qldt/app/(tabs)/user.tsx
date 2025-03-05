import React, { useEffect, useState } from 'react';
import {
  View,
  Text,
  Image,
  StyleSheet,
  TouchableOpacity,
  ScrollView,
} from 'react-native';
import emailService from '@/service/emailService';
import axios from 'axios';
const UserProfileScreen = () => {
  const [name, setName] = useState('');
  const [phone, setPhone] = useState('');
  const [birthday, setBirthday] = useState('');
  const [address, setAdress] = useState('');
  const email = emailService.getEmail();
  useEffect(() => {
    const fetchData = async () => {
      try {
        const res = await axios.get(
          `http://192.168.43.151:5000/new/profile?email=${email}`
        );
        // const res = await axios.get(
        //   `http://127.0.0.1:5000/new/profile?email=${email}`
        // );
        console.log(res.data); // Xử lý dữ liệu từ API
        setName(res.data.name);
        setPhone(res.data.phone);
        setBirthday(res.data.birthday);
        setAdress(res.data.address);
      } catch (error) {
        console.error('Lỗi khi gọi API:', error);
      }
    };

    fetchData();
  }, []);
  return (
    <ScrollView style={styles.container}>
      {/* Header */}
      <View style={styles.header}>
        <Image
          source={require('../../assets/images/hinh-anh-eren-chibi_095801300.jpg')} // Bạn có thể thay ảnh đại diện bằng link hoặc sử dụng require
          style={styles.profileImage}
        />
        <Text style={styles.username}>{name}</Text>
        <Text style={styles.userTag}>{email}</Text>
      </View>

      {/* Information Section */}
      <View style={styles.infoSection}>
        <View style={styles.infoItem}>
          <Text style={styles.label}>Email:</Text>
          <Text style={styles.infoText}>{email}</Text>
        </View>
        <View style={styles.infoItem}>
          <Text style={styles.label}>Phone:</Text>
          <Text style={styles.infoText}>{phone}</Text>
        </View>
        <View style={styles.infoItem}>
          <Text style={styles.label}>Date of Birth:</Text>
          <Text style={styles.infoText}>{birthday}</Text>
        </View>
        <View style={styles.infoItem}>
          <Text style={styles.label}>Location:</Text>
          <Text style={styles.infoText}>{address}</Text>
        </View>
      </View>

      {/* Edit Button */}
      <TouchableOpacity
        style={styles.editButton}
        onPress={() => alert('Edit Profile')}
      >
        <Text style={styles.editButtonText}>Edit Profile</Text>
      </TouchableOpacity>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f9f9f9',
  },
  header: {
    alignItems: 'center',
    marginTop: 20,
    marginBottom: 40,
  },
  profileImage: {
    width: 100,
    height: 100,
    borderRadius: 50,
    marginBottom: 10,
  },
  username: {
    fontSize: 24,
    fontWeight: 'bold',
    color: '#333',
  },
  userTag: {
    fontSize: 14,
    color: '#888',
  },
  infoSection: {
    paddingHorizontal: 20,
  },
  infoItem: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 15,
  },
  label: {
    fontSize: 16,
    fontWeight: '600',
    color: '#333',
  },
  infoText: {
    fontSize: 16,
    color: '#666',
  },
  editButton: {
    backgroundColor: '#4CAF50',
    paddingVertical: 12,
    marginHorizontal: 20,
    marginTop: 30,
    borderRadius: 8,
    alignItems: 'center',
  },
  editButtonText: {
    color: '#fff',
    fontSize: 18,
    fontWeight: 'bold',
  },
});

export default UserProfileScreen;
