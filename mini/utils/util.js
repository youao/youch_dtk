export function formatTime0(date) {
  const year = date.getFullYear()
  const month = date.getMonth() + 1
  const day = date.getDate()
  const hour = date.getHours()
  const minute = date.getMinutes()
  const second = date.getSeconds()

  return [year, month, day].map(formatNumber).join('/') + ' ' + [hour, minute, second].map(formatNumber).join(':')
}

export function formatTime(time, frt) {
  let date = time ? new Date(time) : new Date();
  frt = (frt || 'Y-m-d h:i:s').toLowerCase();

  return frt.replace(/y/g, date.getFullYear())
    .replace(/m/g, date.getMonth() + 1)
    .replace(/d/g, date.getDate())
    .replace(/h/g, date.getHours())
    .replace(/i/g, date.getMinutes())
    .replace(/s/g, date.getSeconds())
}

export function formatNumber(n) {
  n = n.toString()
  return n[1] ? n : '0' + n
}

export function getWanNum(n) {
  return n < 1000 ? n : Math.ceil(n / 1000) / 10 + '万';
}