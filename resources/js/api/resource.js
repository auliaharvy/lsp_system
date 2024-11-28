import request from '@/utils/request';

/**
 * Simple RESTful resource class
 */
class Resource {
  constructor(uri) {
    this.uri = uri;
  }
  list(query) {
    return request({
      url: '/' + this.uri,
      method: 'get',
      params: query,
    });
  }
  get(id) {
    return request({
      url: '/' + this.uri + '/' + id,
      method: 'get',
    });
  }
  store(resource) {
    return request({
      url: '/' + this.uri,
      method: 'post',
      data: resource,
    });
  }
  update(id, resource) {
    return request({
      url: '/' + this.uri + '/' + id,
      method: 'put',
      data: resource,
    });
  }
  destroy(id) {
    return request({
      url: '/' + this.uri + '/' + id,
      method: 'delete',
    });
  }
  download(query) {
    return request({
      url: '/' + this.uri,
      method: 'get',
      params: query,
      responseType: 'blob',
      Accept: 'application/pdf',
    });
  }
  stream(query) {
    return request({
      url: '/' + this.uri,
      method: 'get',
      params: query,
      responseType: 'blob', // ensure we get a blob for PDF
      headers: {
        Accept: 'application/pdf',
      },
    });
  }
}

export { Resource as default };
