import { PublicClientApplication } from '@azure/msal-browser'

export const msalInstance = new PublicClientApplication({
  auth: {
    clientId: 'CLIENT_ID',
    authority: 'https://login.microsoftonline.com/TENANT_ID',
    redirectUri: 'http://localhost:9000',
  },
})

export const loginRequest = {
  scopes: ['https://analysis.windows.net/powerbi/api/.default'],
}

export async function login() {
  return await msalInstance.loginPopup(loginRequest)
}

export async function getAccessToken() {
  let accounts = msalInstance.getAllAccounts()

  if (!accounts.length) {
    await login()
    accounts = msalInstance.getAllAccounts()
  }

  const response = await msalInstance.acquireTokenSilent({
    ...loginRequest,
    account: accounts[0],
  })

  return response.accessToken
}