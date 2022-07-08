import {initializeApp} from 'firebase/app';
import {getAuth} from 'firebase/auth';

const firebaseConfig = {
  apiKey: 'AIzaSyAOTnTs6t0Sen0YsRV2FwGWZh1-9HAbEYQ',
  authDomain: 'icanmart-c24b8.firebaseapp.com',
  databaseURL: 'https://icanmart-c24b8-default-rtdb.firebaseio.com',
  projectId: 'icanmart-c24b8',
  storageBucket: 'icanmart-c24b8.appspot.com',
  messagingSenderId: '587773080603',
  appId: '1:587773080603:web:2059f44a7a30ab2b3c34be'
};

//Initialize Firebase
const app = initializeApp(firebaseConfig);
export const auth = getAuth(app);
