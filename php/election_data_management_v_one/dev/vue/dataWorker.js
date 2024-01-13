// dataWorker.js
self.addEventListener('message', (e) => {
    // Assume e.data is the URL to fetch data from
    fetch(e.data)
      .then(response => response.json())
      .then(data => {
        // Post the data back to the main thread
        self.postMessage(data);
      })
      .catch(error => {
        // Post the error back to the main thread if any
        self.postMessage({ error: error.message });
      });
  });
  