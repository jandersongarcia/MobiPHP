class Mobi {
  constructor() {
    this.post = this.post.bind(this);
  }

  post(url, formId, successCallback, errorCallback) {
    const formData = new FormData(document.getElementById(formId));

    fetch(url, {
      method: "POST",
      body: formData
    })
      .then(response => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text();
      })
      .then(data => {
        successCallback(data);
      })
      .catch(error => {
        errorCallback(error.message);
      });
  }
}

const mobi = new Mobi();