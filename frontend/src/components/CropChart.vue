<template>
  <div>
    <div class="row q-col-gutter-md q-mb-md">
      <div class="col-12 col-md-3">
        <q-select
          v-model="selectedCrop"
          :options="cropOptions"
          label="Crop"
          outlined
          dense
          @update:model-value="loadChartData"
        />
      </div>

      <div class="col-12 col-md-3">
        <q-select
          v-model="selectedYear"
          :options="yearOptions"
          label="Year"
          outlined
          dense
          @update:model-value="loadChartData"
        />
      </div>

      <div class="col-12 col-md-3">
        <q-select
          v-model="selectedMetric"
          :options="metricOptions"
          label="Metric"
          outlined
          dense
          @update:model-value="loadChartData"
        />
      </div>

      <div class="col-12 col-md-3">
        <q-select
          v-model="selectedFarmId"
          :options="farmOptions"
          label="Selected Farm"
          outlined
          dense
          clearable
          @update:model-value="loadChartData"
        />
      </div>
    </div>

    <ApexChartComponent type="bar" height="420" :options="chartOptions" :series="series" />
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { getChartData } from 'src/services/api'

const selectedCrop = ref('Dryland Barley Short Fallow')
const selectedYear = ref(2025)
const selectedMetric = ref('grossmargin')
const selectedFarmId = ref(null)

const cropOptions = ref(['Dryland Barley Short Fallow', 'Dryland Breadwheat Short Fallow'])

const yearOptions = ref([2025])

const metricOptions = ref([
  'grossmargin',
  'grossmargin_t',
  'grossincome',
  'grain_yield',
  'wue',
  'yieldcosts',
])

const farmOptions = ref([423, 425, 434, 435, 437, 445, 446, 451, 452, 453, 459])

const series = ref([
  {
    name: 'Gross Margin',
    data: [],
  },
])

const chartOptions = ref({
  chart: {
    id: 'crop-chart',
    toolbar: {
      show: false,
    },
  },
  legend: {
    show: false,
  },
  plotOptions: {
    bar: {
      distributed: true,
      borderRadius: 2,
      columnWidth: '60%',
    },
  },
  colors: [],
  xaxis: {
    categories: [],
    title: {
      text: 'Farm ID',
    },
  },
  yaxis: {
    title: {
      text: 'Average value',
    },
  },
  title: {
    text: 'Average Gross Margin Per Farm',
    align: 'center',
  },
  dataLabels: {
    enabled: false,
  },
})

async function loadChartData() {
  const params = new URLSearchParams()

  if (selectedCrop.value) {
    params.append('crop', selectedCrop.value)
  }

  if (selectedYear.value) {
    params.append('year', selectedYear.value)
  }

  if (selectedMetric.value) {
    params.append('metric', selectedMetric.value)
  }

  if (selectedFarmId.value) {
    params.append('farm_id', selectedFarmId.value)
  }

  const data = await getChartData(params)

  const farmIds = data.map((row) => String(row.farm_id))
  const values = data.map((row) => Number(row.value))

  const barColors = data.map((row) => (row.highlight ? '#F97316' : '#2563EB'))

  chartOptions.value = {
    ...chartOptions.value,
    colors: barColors,
    xaxis: {
      ...chartOptions.value.xaxis,
      categories: farmIds,
    },
    title: {
      ...chartOptions.value.title,
      text: `Average ${selectedMetric.value} Per Farm`,
      align: 'center',
    },
    subtitle: {
      text:
        `Crop: ${selectedCrop.value} | ` +
        `Year: ${selectedYear.value} | ` +
        `Metric: ${selectedMetric.value}`,

      align: 'center',
    },
  }

  series.value = [
    {
      name: selectedMetric.value,
      data: values,
    },
  ]
}

onMounted(() => {
  loadChartData()
})
</script>
