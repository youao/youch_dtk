export default [{
    path: "/user",
    name: "User",
    meta: {
        title: "个人中心",
        auth: true
    },
    component: () =>
        import ('@/views/user/User')
}]