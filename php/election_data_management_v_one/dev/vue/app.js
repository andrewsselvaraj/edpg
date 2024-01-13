// app.js
// import { createApp } from 'https://unpkg.com/vue@next';
import { createApp } from 'https://unpkg.com/vue@3.2.0/dist/vue.esm-browser.prod.js';

// Rest of your Vue app code...


const ElectionResultsTable = {
  data() {
    return {
      records: [], // This will be populated by the Web Worker
      error: null,
      loading: true
    };
  },
  computed: {
    groupedByPollingStation() {
      // Logic to group records by polling station
    }
  },
  methods: {
    loadData() {
      console.log(phpData)
      this.records = phpData;
      this.loading = false;
      this.error = false;
      // const worker = new Worker('./dataWorker.js');

      // worker.postMessage('http://63.142.240.31/election_data_management_v_one/dev/election_data_api.php'); // Send data source URL to the worker

      // worker.onmessage = (e) => {
      //   if (e.data.error) {
      //     this.error = e.data.error;
      //     this.loading = false;
      //   } else {
      //     this.records = e.data;
      //     this.loading = false;
      //   }

      //   worker.terminate(); // Terminate the worker once the data is received
      // };

      // worker.onerror = (e) => {
      //   this.error = 'Failed to load data.';
      //   this.loading = false;
      // };
    }
  },
  mounted() {
    this.loadData();
  },
  template: `
    <div v-if="loading" class="text-center">Loading...</div>
    <div v-if="error" class="text-red-600">{{ error }}</div>
    <div v-if="!loading && !error">
      <div v-for="(group, station) in groupedByPollingStation" :key="station" class="mb-6">
        <h2 class="text-lg font-bold mb-2">Polling Station: {{ station }}</h2>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Candidate Name
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Party Name
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Votes
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Visual Representation
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="record in group" :key="record.Candidate_Name">
              <td class="px-6 py-4 whitespace-nowrap">{{ record.Candidate_Name }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ record.Party_Name }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ record.No_of_Votes }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="bg-gray-200 h-4 w-full">
                  <div class="bg-blue-600 h-4" :style="{ width: record.No_of_Votes + '%' }"></div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  `
};

createApp(ElectionResultsTable).mount('#app');
