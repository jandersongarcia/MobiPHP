class Mobi {
  constructor() {
    // Vincula os métodos de classe aos seus contextos.
    this.post = this.post.bind(this);
    this.loadRoutes();
  }

  post(url, data, successCallback, errorCallback) {
    const formData = new FormData();
    for (const key in data) {
      formData.append(key, data[key]);
    }

    fetch(url, {
      method: "POST",
      body: formData
    })
      .then(response => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then(data => {
        successCallback(data);
      })
      .catch(error => {
        errorCallback(error.message);
      });
  }

  loadRoutes() {
    fetch('./core/json/routes.json')
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        window.routes = data;
      })
      .catch(error => {
        console.error('Error loading routes:', error.message);
      });
  }
}

const mobi = new Mobi();