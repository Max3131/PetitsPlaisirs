<<<<<<< HEAD
-- Replace 'ButtonName' and 'WallPlugName' with the actual names of your devices in Domoticz.

return {
    on = {
        devices = { 'ButtonName' } -- Name of the button device
    },
    execute = function(domoticz, device)
        if device.state == 'On' then
            local wallPlug = domoticz.devices('WallPlugName') -- Name of the wall plug device
            if wallPlug.state == 'On' then
                wallPlug.switchOff()
            else
                wallPlug.switchOn()
            end
        end
    end
=======
-- Replace 'ButtonName' and 'WallPlugName' with the actual names of your devices in Domoticz.

return {
    on = {
        devices = { 'ButtonName' } -- Name of the button device
    },
    execute = function(domoticz, device)
        if device.state == 'On' then
            local wallPlug = domoticz.devices('WallPlugName') -- Name of the wall plug device
            if wallPlug.state == 'On' then
                wallPlug.switchOff()
            else
                wallPlug.switchOn()
            end
        end
    end
>>>>>>> cf23c0eff3514bfd1b6d530e324419eee276c7b3
}