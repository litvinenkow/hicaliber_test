import axios from 'axios';
import _ from 'lodash';

const API_URL = import.meta.env.VITE_APP_API_URL;

export default async ({
  url = '${API_URL}/',
  method = 'get',
  params = {},
  data = {},
  headers = {},
  files = [],
  responseType = 'json',
  signal = null
}) => {
  url = `${API_URL}${url}`

  if ((!_.isEmpty(data) || !_.isEmpty(files))) {
    if (method.toLowerCase() === 'get') {
      method = 'post';
    }
    if (!_.isEmpty(data) && !headers['Content-Type']) {
      headers['Content-Type'] = 'application/json';
    }
    if (!_.isEmpty(files) && !headers['Content-Type']) {
      data = new FormData();
      if (files && files.length > 0) {
        for (let i = 0; i < files.length; i++) {
          data.append('files[' + i + ']', files[i])
        }
      }
      headers['Content-Type'] = 'multipart/form-data';
    }
  }

  headers['Accept'] = 'application/json';

  let requestData = {
    url,
    method,
    headers,
    params,
    data,
    responseType,
    signal
  }

  const instance = axios.create()
  return await instance(requestData)
}

