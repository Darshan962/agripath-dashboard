<template>
    <q-btn
      color="primary"
      label="Login with Microsoft"
      @click="handleLogin"
    />
  </template>
  
  <script setup>
  import { login, getAccessToken } from 'src/services/auth'
  
  async function handleLogin() {
    try {
      await login()
      const token = await getAccessToken()
      console.log('Power BI access token:', token)
    } catch (error) {
      console.error('Microsoft login failed:', error)
    }
  }
  </script>