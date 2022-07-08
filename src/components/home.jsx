import React from 'react';
import {useNavigate} from 'react-router-dom';
//import styles from './home.module.css'

const Home = (props) => {
  const navigate = useNavigate();
  return (
    <>
      <h1> Home</h1>
      <button
        onClick={() => {
          navigate('/profile');
        }}
      >
        go to profile
      </button>
    </>
  );
};

export default Home;
