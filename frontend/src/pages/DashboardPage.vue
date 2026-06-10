<template>
    <q-page class="q-pa-md">
      <div class="text-h4 q-mb-md">Dashboard</div>
      
      <LoginButton /> 
      
      <q-card class="q-mb-md">
        <q-card-section>
          <div class="text-h6 q-mb-sm">Power BI Report Container</div>
          <div ref="reportContainer" class="report-container">
            Power BI report will be embedded here later.
          </div>
        </q-card-section>
      </q-card>
  
      <q-card v-if="loading" class="q-pa-md">
        Loading reports...
      </q-card>
  
      <q-card v-else-if="error" class="q-pa-md text-negative">
        {{ error }}
      </q-card>
  
      <q-card v-else class="q-mb-md">
        <q-card-section>
          <div class="text-h6 q-mb-sm">Reports From Laravel API</div>
  
          <div v-for="report in reports" :key="report.id" class="q-mb-md">
            <div class="text-subtitle1 text-weight-bold">{{ report.name }}</div>
            <div>Report ID: {{ report.report_id }}</div>
            <div>Workspace ID: {{ report.workspace_id }}</div>
            <div>Embed URL: {{ report.embed_url }}</div>
          </div>
        </q-card-section>
      </q-card>
  
      <q-card>
        <q-card-section>
          <div class="text-h6 q-mb-sm">Markdown Analysis</div>
          <div class="markdown-analysis" v-html="compiledMarkdown"></div>
        </q-card-section>
      </q-card>
    </q-page>
  </template>
  
  <script setup>
  import { computed, onMounted, ref } from 'vue'
  import LoginButton from 'src/components/LoginButton.vue'
  import { marked } from 'marked'
  
  const reports = ref([])
  const loading = ref(true)
  const error = ref(null)
  const reportContainer = ref(null)
  
  const markdown = ref(`
  ## Chart Analysis
  
  - Sales increased by **23%**.
  - NSW is the strongest performing region.
  - Marketing performance declined in Q2.
  `)
  
  const compiledMarkdown = computed(() => marked(markdown.value))
  
  onMounted(async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/reports')
      const data = await response.json()
      reports.value = data.reports
      console.log('Reports loaded:', data)
    } catch (err) {
      console.error('Failed to load reports:', err)
      error.value = 'Could not load reports from Laravel API.'
    } finally {
      loading.value = false
    }
  })
  </script>
  
  <style scoped>
  .report-container {
    height: 300px;
    border: 1px dashed #999;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
  }
  
  .markdown-analysis :deep(h2) {
    margin-top: 0;
  }
  </style>