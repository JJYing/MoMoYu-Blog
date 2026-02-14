(async function() {
    const statsContainer = document.getElementById('online-users-stats');
    
    if (!statsContainer) {
        return;
    }

    // 使用 CORS 代理服务来绕过跨域限制
    // 方案1: 使用 allorigins.win (推荐，稳定)
    const proxyUrl = 'https://api.allorigins.win/raw?url=';
    const targetUrl = encodeURIComponent('https://momoyu.app/logs/online_users_cache.json');
    
    // 方案2: 如果方案1不可用，可以尝试使用 corsproxy.io
    // const proxyUrl = 'https://corsproxy.io/?';
    // const targetUrl = 'https://momoyu.app/logs/online_users_cache.json';

    try {
        const response = await fetch(proxyUrl + targetUrl);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        // 验证数据格式
        if (!data.users || !Array.isArray(data.users) || data.users.length === 0) {
            throw new Error('数据格式错误：用户列表为空');
        }
        
        // 计算所有用户的 idle_rate 平均值
        const totalIdleRate = data.users.reduce((sum, user) => sum + (user.idle_rate || 0), 0);
        const averageIdleRate = Math.round(totalIdleRate / data.users.length);
        
        // 显示统计信息
        statsContainer.innerHTML = `
            <div class="stats-item">
                <div class="stats-label">目前在线用户数量</div>
                <div class="stats-value">${data.total || data.users.length}</div>
            </div>
            <div class="stats-item">
                <div class="stats-label">用户整体摸鱼率</div>
                <div class="stats-value">${averageIdleRate}%</div>
            </div>
        `;
    } catch (error) {
        console.error('获取在线用户数据失败:', error);
        statsContainer.innerHTML = `
            <div class="stats-error">
                <p>加载数据失败，请稍后重试。</p>
                <p class="stats-error-detail">${error.message}</p>
                <p class="stats-error-detail" style="margin-top: 0.5rem; font-size: 0.85em;">
                    提示：如果持续失败，可能需要配置 momoyu.app 服务器的 CORS 头，允许 blog.momoyu.app 访问。
                </p>
            </div>
        `;
    }
})();

