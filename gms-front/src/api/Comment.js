export default class Comment {
  static push(pid, name, content) {
    var formdata = new FormData();
    formdata.append("pid", pid);
    formdata.append("author", name);
    formdata.append("body", content);

    var requestOptions = {
      method: "POST",
      body: formdata,
      redirect: "follow",
    };

    return fetch(
      "http://localhost:8765/comments/add.json",
      requestOptions
    ).then((response) => response.json());
  }
}