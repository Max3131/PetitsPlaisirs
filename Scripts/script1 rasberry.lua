return{
    on = {
        devices = {"b1 ext"}
    },
    execute = function(domoticz, device)
        if device.state == 'On' then
            local scriptPath = domoticz.helpers.getScriptPath() .. "../parentFolder/script2.lua"
            local script = assert(loadfile(scriptPath))
            script()
}