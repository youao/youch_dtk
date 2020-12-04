import request from "./../utils/request.js";
const app = getApp();
/**
 * 
 */
export function getAccessToken() {
  const {
    AppID,
    AppSecret
  } = app.globalData;
  return request.post("/cgi-bin/token", {
    grant_type: 'client_credential',
    appid: AppID,
    secret: AppSecret
  }, {
    wxOpen: 1
  });
}