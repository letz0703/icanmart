import React from 'react';
import {useNavigate} from 'react-router-dom';
//import styles from './profile.module.css'

const Profile = (props) => {
  const navigate = useNavigate();
  return (
    <>
      <h1>Profile</h1>
      <button
        onClick={() => {
          navigate('/');
        }}
      >
        goto home
      </button>
    </>
  );
};
export default Profile;
