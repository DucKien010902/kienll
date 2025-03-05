import {
  Image,
  StyleSheet,
  Platform,
  Button,
  ImageBackground,
} from 'react-native';
import React from 'react';
import { HelloWave } from '@/components/HelloWave';
import ParallaxScrollView from '@/components/ParallaxScrollView';
import { ThemedText } from '@/components/ThemedText';
import { ThemedView } from '@/components/ThemedView';
import { View } from 'react-native-reanimated/lib/typescript/Animated';
import { useState } from 'react';
import { useNavigation } from 'expo-router';
import axios from 'axios';
export default function HomeScreen({ navigation }) {
  const [num, setNum] = useState(0);
  const fetchnum = async () => {
    try {
      const res = await axios.get(
        `http://192.168.43.151:5000/search/duckien?num=${num}`
      );
      // const res = await axios.get(
      //   `http://127.0.0.1:5000/search/duckien?num=${num}`
      // );
      setNum(res.data.message);
    } catch (error) {
      alert('loi roi: ' + error);
    }
  };
  return (
    <ParallaxScrollView
      headerBackgroundColor={{ light: '#FFFFFF', dark: '#1D3D47' }}
      headerImage={
        <Image
          source={require('@/assets/images/cntt.jpg')}
          style={styles.reactLogo}
        />
      }
    >
      <Image
        source={require('@/assets/images/cntt.jpg')}
        style={styles.reactLogo}
      />
      <ThemedView style={styles.titleContainer}>
        <ThemedText style={styles.tittleContainerText}>
          Welcome to My App!
        </ThemedText>
        <HelloWave />
      </ThemedView>
      <ThemedView style={styles.stepContainer}>
        <ThemedText type="subtitle" style={{ color: 'red' }}>
          Step 1: Try it
        </ThemedText>
        <ThemedText>
          Edit{' '}
          <ThemedText type="defaultSemiBold">app/(tabs)/index.tsx</ThemedText>{' '}
          to see changes. Press{' '}
          <ThemedText type="defaultSemiBold">
            {Platform.select({ ios: 'cmd + d', android: 'cmd + m' })}
          </ThemedText>{' '}
          to open developer tools.
        </ThemedText>
      </ThemedView>
      <ThemedView style={styles.stepContainer}>
        <ThemedText type="subtitle" style={{ color: 'green' }}>
          Step 2: Explore
        </ThemedText>
        <ThemedText>
          Tap the Explore tab to learn more about what's included in this
          starter app.
        </ThemedText>
      </ThemedView>
      <ThemedView style={styles.stepContainer}>
        <ThemedText type="subtitle" style={{ color: 'orange' }}>
          Step 3: Get a fresh start
        </ThemedText>
        <ThemedText>
          When you're ready, run{' '}
          <ThemedText type="defaultSemiBold">npm run reset-project</ThemedText>{' '}
          to get a fresh <ThemedText type="defaultSemiBold">app</ThemedText>{' '}
          directory. This will move the current{' '}
          <ThemedText type="defaultSemiBold">app</ThemedText> to{' '}
          <ThemedText type="defaultSemiBold">app-example</ThemedText>.
        </ThemedText>
      </ThemedView>
      <ThemedView style={styles.stepContainer}>
        <ThemedText type="subtitle" style={{ color: '#00cccc' }}>
          Step 4: Click
        </ThemedText>
      </ThemedView>
      <Button
        title="Go"
        onPress={() => {
          navigation.navigate('user');
        }}
      />
      <Button title={`${num}`} onPress={() => fetchnum()} />
    </ParallaxScrollView>
  );
}

const styles = StyleSheet.create({
  titleContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 8,
  },
  tittleContainerText: {
    color: 'blue',
    fontWeight: '600',
    fontSize: 28,
    paddingTop: 10,
    paddingLeft: 5,
  },
  stepContainer: {
    gap: 8,
    marginBottom: 8,
  },
  reactLogo: {
    height: 240,
    width: '100%',
    bottom: 0,
    left: 0,
    // position: 'absolute',
    resizeMode: 'contain',
  },
});
