async function generateDeviceFingerprint() {
    try {
        const components = {
            userAgent: navigator.userAgent,
            language: navigator.language,
            platform: navigator.platform,
            hardwareConcurrency: navigator.hardwareConcurrency || 0,
            screen: `${screen.width}x${screen.height}x${screen.colorDepth}`,
            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
            timezoneOffset: new Date().getTimezoneOffset(),
        };

        const dataString = JSON.stringify(components);
        const hash = await hashSHA256(dataString);
        return hash;
    } catch (error) {
        const fallback = 'fallback-' + Date.now() + '-' + Math.random().toString(36).substring(7);
        return fallback;
    }
}

async function hashSHA256(text) {
    try {
        const encoder = new TextEncoder();
        const data = encoder.encode(text);
        const hashBuffer = await crypto.subtle.digest('SHA-256', data);
        const hashArray = Array.from(new Uint8Array(hashBuffer));
        const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
        return hashHex;
    } catch (error) {
        return 'hash-error-' + Date.now();
    }
}

window.generateDeviceFingerprint = generateDeviceFingerprint;

const DeviceFingerprint = {
    async init() {
        return await generateDeviceFingerprint();
    },
    async generate() {
        return await generateDeviceFingerprint();
    }
};

window.DeviceFingerprint = DeviceFingerprint;
