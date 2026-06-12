const API_URL = 'http://127.0.0.1:8000/api'

export async function getReports() {
  const response = await fetch(`${API_URL}/reports`)
  return response.json()
}

export async function getChartData(params) {
  const response = await fetch(
    `${API_URL}/crop-data/chart?${params.toString()}`
  )

  return response.json()
}