<?php
/*********************************************************************
 *
 * $Id: pic24config.php 25964 2016-11-21 15:30:59Z mvuilleu $
 *
 * Implements YStepperMotor, the high-level API for StepperMotor functions
 *
 * - - - - - - - - - License information: - - - - - - - - - 
 *
 *  Copyright (C) 2011 and beyond by Yoctopuce Sarl, Switzerland.
 *
 *  Yoctopuce Sarl (hereafter Licensor) grants to you a perpetual
 *  non-exclusive license to use, modify, copy and integrate this
 *  file into your software for the sole purpose of interfacing
 *  with Yoctopuce products.
 *
 *  You may reproduce and distribute copies of this file in
 *  source or object form, as long as the sole purpose of this
 *  code is to interface with Yoctopuce products. You must retain
 *  this notice in the distributed source file.
 *
 *  You should refer to Yoctopuce General Terms and Conditions
 *  for additional information regarding your rights and
 *  obligations.
 *
 *  THE SOFTWARE AND DOCUMENTATION ARE PROVIDED 'AS IS' WITHOUT
 *  WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING 
 *  WITHOUT LIMITATION, ANY WARRANTY OF MERCHANTABILITY, FITNESS
 *  FOR A PARTICULAR PURPOSE, TITLE AND NON-INFRINGEMENT. IN NO
 *  EVENT SHALL LICENSOR BE LIABLE FOR ANY INCIDENTAL, SPECIAL,
 *  INDIRECT OR CONSEQUENTIAL DAMAGES, LOST PROFITS OR LOST DATA,
 *  COST OF PROCUREMENT OF SUBSTITUTE GOODS, TECHNOLOGY OR
 *  SERVICES, ANY CLAIMS BY THIRD PARTIES (INCLUDING BUT NOT
 *  LIMITED TO ANY DEFENSE THEREOF), ANY CLAIMS FOR INDEMNITY OR
 *  CONTRIBUTION, OR OTHER SIMILAR COSTS, WHETHER ASSERTED ON THE
 *  BASIS OF CONTRACT, TORT (INCLUDING NEGLIGENCE), BREACH OF
 *  WARRANTY, OR OTHERWISE.
 *
 *********************************************************************/

//--- (YStepperMotor return codes)
//--- (end of YStepperMotor return codes)
//--- (YStepperMotor definitions)
if(!defined('Y_MOTORSTATE_ABSENT'))          define('Y_MOTORSTATE_ABSENT',         0);
if(!defined('Y_MOTORSTATE_ALERT'))           define('Y_MOTORSTATE_ALERT',          1);
if(!defined('Y_MOTORSTATE_HI_Z'))            define('Y_MOTORSTATE_HI_Z',           2);
if(!defined('Y_MOTORSTATE_STOP'))            define('Y_MOTORSTATE_STOP',           3);
if(!defined('Y_MOTORSTATE_RUN'))             define('Y_MOTORSTATE_RUN',            4);
if(!defined('Y_MOTORSTATE_BATCH'))           define('Y_MOTORSTATE_BATCH',          5);
if(!defined('Y_MOTORSTATE_INVALID'))         define('Y_MOTORSTATE_INVALID',        -1);
if(!defined('Y_STEPPING_MICROSTEP16'))       define('Y_STEPPING_MICROSTEP16',      0);
if(!defined('Y_STEPPING_MICROSTEP8'))        define('Y_STEPPING_MICROSTEP8',       1);
if(!defined('Y_STEPPING_MICROSTEP4'))        define('Y_STEPPING_MICROSTEP4',       2);
if(!defined('Y_STEPPING_HALFSTEP'))          define('Y_STEPPING_HALFSTEP',         3);
if(!defined('Y_STEPPING_FULLSTEP'))          define('Y_STEPPING_FULLSTEP',         4);
if(!defined('Y_STEPPING_INVALID'))           define('Y_STEPPING_INVALID',          -1);
if(!defined('Y_DIAGS_INVALID'))              define('Y_DIAGS_INVALID',             YAPI_INVALID_UINT);
if(!defined('Y_STEPPOS_INVALID'))            define('Y_STEPPOS_INVALID',           YAPI_INVALID_DOUBLE);
if(!defined('Y_SPEED_INVALID'))              define('Y_SPEED_INVALID',             YAPI_INVALID_DOUBLE);
if(!defined('Y_PULLINSPEED_INVALID'))        define('Y_PULLINSPEED_INVALID',       YAPI_INVALID_DOUBLE);
if(!defined('Y_MAXACCEL_INVALID'))           define('Y_MAXACCEL_INVALID',          YAPI_INVALID_DOUBLE);
if(!defined('Y_MAXSPEED_INVALID'))           define('Y_MAXSPEED_INVALID',          YAPI_INVALID_DOUBLE);
if(!defined('Y_USTEPMAXSPEED_INVALID'))      define('Y_USTEPMAXSPEED_INVALID',     YAPI_INVALID_DOUBLE);
if(!defined('Y_OVERCURRENT_INVALID'))        define('Y_OVERCURRENT_INVALID',       YAPI_INVALID_UINT);
if(!defined('Y_TCURRSTOP_INVALID'))          define('Y_TCURRSTOP_INVALID',         YAPI_INVALID_UINT);
if(!defined('Y_TCURRRUN_INVALID'))           define('Y_TCURRRUN_INVALID',          YAPI_INVALID_UINT);
if(!defined('Y_ALERTMODE_INVALID'))          define('Y_ALERTMODE_INVALID',         YAPI_INVALID_STRING);
if(!defined('Y_COMMAND_INVALID'))            define('Y_COMMAND_INVALID',           YAPI_INVALID_STRING);
//--- (end of YStepperMotor definitions)

//--- (YStepperMotor declaration)
/**
 * YStepperMotor Class: StepperMotor function interface
 *
 * The Yoctopuce application programming interface allows you to drive a stepper motor.
 */
class YStepperMotor extends YFunction
{
    const MOTORSTATE_ABSENT              = 0;
    const MOTORSTATE_ALERT               = 1;
    const MOTORSTATE_HI_Z                = 2;
    const MOTORSTATE_STOP                = 3;
    const MOTORSTATE_RUN                 = 4;
    const MOTORSTATE_BATCH               = 5;
    const MOTORSTATE_INVALID             = -1;
    const DIAGS_INVALID                  = YAPI_INVALID_UINT;
    const STEPPOS_INVALID                = YAPI_INVALID_DOUBLE;
    const SPEED_INVALID                  = YAPI_INVALID_DOUBLE;
    const PULLINSPEED_INVALID            = YAPI_INVALID_DOUBLE;
    const MAXACCEL_INVALID               = YAPI_INVALID_DOUBLE;
    const MAXSPEED_INVALID               = YAPI_INVALID_DOUBLE;
    const STEPPING_MICROSTEP16           = 0;
    const STEPPING_MICROSTEP8            = 1;
    const STEPPING_MICROSTEP4            = 2;
    const STEPPING_HALFSTEP              = 3;
    const STEPPING_FULLSTEP              = 4;
    const STEPPING_INVALID               = -1;
    const USTEPMAXSPEED_INVALID          = YAPI_INVALID_DOUBLE;
    const OVERCURRENT_INVALID            = YAPI_INVALID_UINT;
    const TCURRSTOP_INVALID              = YAPI_INVALID_UINT;
    const TCURRRUN_INVALID               = YAPI_INVALID_UINT;
    const ALERTMODE_INVALID              = YAPI_INVALID_STRING;
    const COMMAND_INVALID                = YAPI_INVALID_STRING;
    //--- (end of YStepperMotor declaration)

    //--- (YStepperMotor attributes)
    protected $_motorState               = Y_MOTORSTATE_INVALID;         // StepperState
    protected $_diags                    = Y_DIAGS_INVALID;              // StepperDiags
    protected $_stepPos                  = Y_STEPPOS_INVALID;            // StepPos
    protected $_speed                    = Y_SPEED_INVALID;              // MeasureVal
    protected $_pullinSpeed              = Y_PULLINSPEED_INVALID;        // MeasureVal
    protected $_maxAccel                 = Y_MAXACCEL_INVALID;           // MeasureVal
    protected $_maxSpeed                 = Y_MAXSPEED_INVALID;           // MeasureVal
    protected $_stepping                 = Y_STEPPING_INVALID;           // SteppingMode
    protected $_ustepMaxSpeed            = Y_USTEPMAXSPEED_INVALID;      // MeasureVal
    protected $_overcurrent              = Y_OVERCURRENT_INVALID;        // UInt31
    protected $_tCurrStop                = Y_TCURRSTOP_INVALID;          // UInt31
    protected $_tCurrRun                 = Y_TCURRRUN_INVALID;           // UInt31
    protected $_alertMode                = Y_ALERTMODE_INVALID;          // AlertMode
    protected $_command                  = Y_COMMAND_INVALID;            // Text
    //--- (end of YStepperMotor attributes)

    function __construct($str_func)
    {
        //--- (YStepperMotor constructor)
        parent::__construct($str_func);
        $this->_className = 'StepperMotor';

        //--- (end of YStepperMotor constructor)
    }

    //--- (YStepperMotor implementation)

    function _parseAttr($name, $val)
    {
        switch($name) {
        case 'motorState':
            $this->_motorState = intval($val);
            return 1;
        case 'diags':
            $this->_diags = intval($val);
            return 1;
        case 'stepPos':
            $this->_stepPos = $val / 16.0;
            return 1;
        case 'speed':
            $this->_speed = round($val * 1000.0 / 65536.0) / 1000.0;
            return 1;
        case 'pullinSpeed':
            $this->_pullinSpeed = round($val * 1000.0 / 65536.0) / 1000.0;
            return 1;
        case 'maxAccel':
            $this->_maxAccel = round($val * 1000.0 / 65536.0) / 1000.0;
            return 1;
        case 'maxSpeed':
            $this->_maxSpeed = round($val * 1000.0 / 65536.0) / 1000.0;
            return 1;
        case 'stepping':
            $this->_stepping = intval($val);
            return 1;
        case 'ustepMaxSpeed':
            $this->_ustepMaxSpeed = round($val * 1000.0 / 65536.0) / 1000.0;
            return 1;
        case 'overcurrent':
            $this->_overcurrent = intval($val);
            return 1;
        case 'tCurrStop':
            $this->_tCurrStop = intval($val);
            return 1;
        case 'tCurrRun':
            $this->_tCurrRun = intval($val);
            return 1;
        case 'alertMode':
            $this->_alertMode = $val;
            return 1;
        case 'command':
            $this->_command = $val;
            return 1;
        }
        return parent::_parseAttr($name, $val);
    }

    /**
     * Returns the motor working state.
     *
     * @return a value among Y_MOTORSTATE_ABSENT, Y_MOTORSTATE_ALERT, Y_MOTORSTATE_HI_Z,
     * Y_MOTORSTATE_STOP, Y_MOTORSTATE_RUN and Y_MOTORSTATE_BATCH corresponding to the motor working state
     *
     * On failure, throws an exception or returns Y_MOTORSTATE_INVALID.
     */
    public function get_motorState()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_MOTORSTATE_INVALID;
            }
        }
        return $this->_motorState;
    }

    /**
     * Returns the stepper motor controller diagnostics, as a bitmap.
     *
     * @return an integer corresponding to the stepper motor controller diagnostics, as a bitmap
     *
     * On failure, throws an exception or returns Y_DIAGS_INVALID.
     */
    public function get_diags()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_DIAGS_INVALID;
            }
        }
        return $this->_diags;
    }

    /**
     * Changes the current logical motor position, measured in steps.
     * This command does not cause any motor move, as its purpose is only to setup
     * the origin of the position counter. The fractional part of the position,
     * that corresponds to the physical position of the rotor, is not changed.
     * To trigger a motor move, use methods moveTo() or moveRel()
     * instead.
     *
     * @param newval : a floating point number corresponding to the current logical motor position, measured in steps
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_stepPos($newval)
    {
        $rest_val = strval(round($newval * 100.0)/100.0);
        return $this->_setAttr("stepPos",$rest_val);
    }

    /**
     * Returns the current logical motor position, measured in steps.
     * The value may include a fractional part when micro-stepping is in use.
     *
     * @return a floating point number corresponding to the current logical motor position, measured in steps
     *
     * On failure, throws an exception or returns Y_STEPPOS_INVALID.
     */
    public function get_stepPos()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_STEPPOS_INVALID;
            }
        }
        return $this->_stepPos;
    }

    /**
     * Returns current motor speed, measured in steps per second.
     * To change speed, use method changeSpeed().
     *
     * @return a floating point number corresponding to current motor speed, measured in steps per second
     *
     * On failure, throws an exception or returns Y_SPEED_INVALID.
     */
    public function get_speed()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_SPEED_INVALID;
            }
        }
        return $this->_speed;
    }

    /**
     * Changes the motor speed immediately reachable from stop state, measured in steps per second.
     *
     * @param newval : a floating point number corresponding to the motor speed immediately reachable from
     * stop state, measured in steps per second
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_pullinSpeed($newval)
    {
        $rest_val = strval(round($newval * 65536.0));
        return $this->_setAttr("pullinSpeed",$rest_val);
    }

    /**
     * Returns the motor speed immediately reachable from stop state, measured in steps per second.
     *
     * @return a floating point number corresponding to the motor speed immediately reachable from stop
     * state, measured in steps per second
     *
     * On failure, throws an exception or returns Y_PULLINSPEED_INVALID.
     */
    public function get_pullinSpeed()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_PULLINSPEED_INVALID;
            }
        }
        return $this->_pullinSpeed;
    }

    /**
     * Changes the maximal motor acceleration, measured in steps per second^2.
     *
     * @param newval : a floating point number corresponding to the maximal motor acceleration, measured
     * in steps per second^2
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_maxAccel($newval)
    {
        $rest_val = strval(round($newval * 65536.0));
        return $this->_setAttr("maxAccel",$rest_val);
    }

    /**
     * Returns the maximal motor acceleration, measured in steps per second^2.
     *
     * @return a floating point number corresponding to the maximal motor acceleration, measured in steps per second^2
     *
     * On failure, throws an exception or returns Y_MAXACCEL_INVALID.
     */
    public function get_maxAccel()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_MAXACCEL_INVALID;
            }
        }
        return $this->_maxAccel;
    }

    /**
     * Changes the maximal motor speed, measured in steps per second.
     *
     * @param newval : a floating point number corresponding to the maximal motor speed, measured in steps per second
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_maxSpeed($newval)
    {
        $rest_val = strval(round($newval * 65536.0));
        return $this->_setAttr("maxSpeed",$rest_val);
    }

    /**
     * Returns the maximal motor speed, measured in steps per second.
     *
     * @return a floating point number corresponding to the maximal motor speed, measured in steps per second
     *
     * On failure, throws an exception or returns Y_MAXSPEED_INVALID.
     */
    public function get_maxSpeed()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_MAXSPEED_INVALID;
            }
        }
        return $this->_maxSpeed;
    }

    /**
     * Returns the stepping mode used to drive the motor.
     *
     * @return a value among Y_STEPPING_MICROSTEP16, Y_STEPPING_MICROSTEP8, Y_STEPPING_MICROSTEP4,
     * Y_STEPPING_HALFSTEP and Y_STEPPING_FULLSTEP corresponding to the stepping mode used to drive the motor
     *
     * On failure, throws an exception or returns Y_STEPPING_INVALID.
     */
    public function get_stepping()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_STEPPING_INVALID;
            }
        }
        return $this->_stepping;
    }

    /**
     * Changes the stepping mode used to drive the motor.
     *
     * @param newval : a value among Y_STEPPING_MICROSTEP16, Y_STEPPING_MICROSTEP8, Y_STEPPING_MICROSTEP4,
     * Y_STEPPING_HALFSTEP and Y_STEPPING_FULLSTEP corresponding to the stepping mode used to drive the motor
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_stepping($newval)
    {
        $rest_val = strval($newval);
        return $this->_setAttr("stepping",$rest_val);
    }

    /**
     * Changes the maximal motor speed for micro-stepping, measured in steps per second.
     *
     * @param newval : a floating point number corresponding to the maximal motor speed for
     * micro-stepping, measured in steps per second
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_ustepMaxSpeed($newval)
    {
        $rest_val = strval(round($newval * 65536.0));
        return $this->_setAttr("ustepMaxSpeed",$rest_val);
    }

    /**
     * Returns the maximal motor speed for micro-stepping, measured in steps per second.
     *
     * @return a floating point number corresponding to the maximal motor speed for micro-stepping,
     * measured in steps per second
     *
     * On failure, throws an exception or returns Y_USTEPMAXSPEED_INVALID.
     */
    public function get_ustepMaxSpeed()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_USTEPMAXSPEED_INVALID;
            }
        }
        return $this->_ustepMaxSpeed;
    }

    /**
     * Returns the overcurrent alert and emergency stop threshold, measured in mA.
     *
     * @return an integer corresponding to the overcurrent alert and emergency stop threshold, measured in mA
     *
     * On failure, throws an exception or returns Y_OVERCURRENT_INVALID.
     */
    public function get_overcurrent()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_OVERCURRENT_INVALID;
            }
        }
        return $this->_overcurrent;
    }

    /**
     * Changes the overcurrent alert and emergency stop threshold, measured in mA.
     *
     * @param newval : an integer corresponding to the overcurrent alert and emergency stop threshold, measured in mA
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_overcurrent($newval)
    {
        $rest_val = strval($newval);
        return $this->_setAttr("overcurrent",$rest_val);
    }

    /**
     * Returns the torque regulation current when the motor is stopped, measured in mA.
     *
     * @return an integer corresponding to the torque regulation current when the motor is stopped, measured in mA
     *
     * On failure, throws an exception or returns Y_TCURRSTOP_INVALID.
     */
    public function get_tCurrStop()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_TCURRSTOP_INVALID;
            }
        }
        return $this->_tCurrStop;
    }

    /**
     * Changes the torque regulation current when the motor is stopped, measured in mA.
     *
     * @param newval : an integer corresponding to the torque regulation current when the motor is
     * stopped, measured in mA
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_tCurrStop($newval)
    {
        $rest_val = strval($newval);
        return $this->_setAttr("tCurrStop",$rest_val);
    }

    /**
     * Returns the torque regulation current when the motor is running, measured in mA.
     *
     * @return an integer corresponding to the torque regulation current when the motor is running, measured in mA
     *
     * On failure, throws an exception or returns Y_TCURRRUN_INVALID.
     */
    public function get_tCurrRun()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_TCURRRUN_INVALID;
            }
        }
        return $this->_tCurrRun;
    }

    /**
     * Changes the torque regulation current when the motor is running, measured in mA.
     *
     * @param newval : an integer corresponding to the torque regulation current when the motor is
     * running, measured in mA
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function set_tCurrRun($newval)
    {
        $rest_val = strval($newval);
        return $this->_setAttr("tCurrRun",$rest_val);
    }

    public function get_alertMode()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_ALERTMODE_INVALID;
            }
        }
        return $this->_alertMode;
    }

    public function set_alertMode($newval)
    {
        $rest_val = $newval;
        return $this->_setAttr("alertMode",$rest_val);
    }

    public function get_command()
    {
        if ($this->_cacheExpiration <= YAPI::GetTickCount()) {
            if ($this->load(YAPI::$defaultCacheValidity) != YAPI_SUCCESS) {
                return Y_COMMAND_INVALID;
            }
        }
        return $this->_command;
    }

    public function set_command($newval)
    {
        $rest_val = $newval;
        return $this->_setAttr("command",$rest_val);
    }

    /**
     * Retrieves a stepper motor for a given identifier.
     * The identifier can be specified using several formats:
     * <ul>
     * <li>FunctionLogicalName</li>
     * <li>ModuleSerialNumber.FunctionIdentifier</li>
     * <li>ModuleSerialNumber.FunctionLogicalName</li>
     * <li>ModuleLogicalName.FunctionIdentifier</li>
     * <li>ModuleLogicalName.FunctionLogicalName</li>
     * </ul>
     *
     * This function does not require that the stepper motor is online at the time
     * it is invoked. The returned object is nevertheless valid.
     * Use the method YStepperMotor.isOnline() to test if the stepper motor is
     * indeed online at a given time. In case of ambiguity when looking for
     * a stepper motor by logical name, no error is notified: the first instance
     * found is returned. The search is performed first by hardware name,
     * then by logical name.
     *
     * @param func : a string that uniquely characterizes the stepper motor
     *
     * @return a YStepperMotor object allowing you to drive the stepper motor.
     */
    public static function FindStepperMotor($func)
    {
        // $obj                    is a YStepperMotor;
        $obj = YFunction::_FindFromCache('StepperMotor', $func);
        if ($obj == null) {
            $obj = new YStepperMotor($func);
            YFunction::_AddToCache('StepperMotor', $func, $obj);
        }
        return $obj;
    }

    public function sendCommand($command)
    {
        return $this->set_command($command);
    }

    /**
     * Reinitialize the controller and clear all alert flags.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *         On failure, throws an exception or returns a negative error code.
     */
    public function reset()
    {
        return $this->sendCommand('Z');
    }

    /**
     * Starts the motor backward at the specified speed, to search for the motor home position.
     *
     * @param speed : desired speed, in steps per second.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *         On failure, throws an exception or returns a negative error code.
     */
    public function findHomePosition($speed)
    {
        return $this->sendCommand('H');
    }

    /**
     * Starts the motor at a given speed. The time needed to reach the requested speed
     * will depend on the acceleration parameters configured for the motor.
     *
     * @param speed : desired speed, in steps per second. The minimal non-zero speed
     *         is 0.001 pulse per second.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *         On failure, throws an exception or returns a negative error code.
     */
    public function changeSpeed($speed)
    {
        return $this->sendCommand(sprintf('R%d',round(1000*$speed)));
    }

    /**
     * Starts the motor to reach a given absolute position. The time needed to reach the requested
     * position will depend on the acceleration and max speed parameters configured for
     * the motor.
     *
     * @param absPos : absolute position, measured in steps from the origin.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *         On failure, throws an exception or returns a negative error code.
     */
    public function moveTo($absPos)
    {
        return $this->sendCommand(sprintf('M%d',round(16*$absPos)));
    }

    /**
     * Starts the motor to reach a given absolute position. The time needed to reach the requested
     * position will depend on the acceleration and max speed parameters configured for
     * the motor.
     *
     * @param relPos : relative position, measured in steps from the current position.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *
     * On failure, throws an exception or returns a negative error code.
     */
    public function moveRel($relPos)
    {
        return $this->sendCommand(sprintf('m%d',round(16*$relPos)));
    }

    /**
     * Stops the motor with an emergency alert, without taking any additional precaution.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *         On failure, throws an exception or returns a negative error code.
     */
    public function emergencyStop()
    {
        return $this->sendCommand('!');
    }

    /**
     * Move one step in the direction opposite the direction set when the most recent alert was raised.
     * The move occures even if the system is still in alert mode (end switch depressed). Caution.
     * use this function with great care as it may cause mechanical damages !
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *         On failure, throws an exception or returns a negative error code.
     */
    public function alertStepOut()
    {
        return $this->sendCommand('.');
    }

    /**
     * Stops the motor smoothly as soon as possible, without waiting for ongoing move completion.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *         On failure, throws an exception or returns a negative error code.
     */
    public function abortAndBrake()
    {
        return $this->sendCommand('B');
    }

    /**
     * Turn the controller into Hi-Z mode immediately, without waiting for ongoing move completion.
     *
     * @return YAPI_SUCCESS if the call succeeds.
     *         On failure, throws an exception or returns a negative error code.
     */
    public function abortAndHiZ()
    {
        return $this->sendCommand('z');
    }

    public function motorState()
    { return $this->get_motorState(); }

    public function diags()
    { return $this->get_diags(); }

    public function setStepPos($newval)
    { return $this->set_stepPos($newval); }

    public function stepPos()
    { return $this->get_stepPos(); }

    public function speed()
    { return $this->get_speed(); }

    public function setPullinSpeed($newval)
    { return $this->set_pullinSpeed($newval); }

    public function pullinSpeed()
    { return $this->get_pullinSpeed(); }

    public function setMaxAccel($newval)
    { return $this->set_maxAccel($newval); }

    public function maxAccel()
    { return $this->get_maxAccel(); }

    public function setMaxSpeed($newval)
    { return $this->set_maxSpeed($newval); }

    public function maxSpeed()
    { return $this->get_maxSpeed(); }

    public function stepping()
    { return $this->get_stepping(); }

    public function setStepping($newval)
    { return $this->set_stepping($newval); }

    public function setUstepMaxSpeed($newval)
    { return $this->set_ustepMaxSpeed($newval); }

    public function ustepMaxSpeed()
    { return $this->get_ustepMaxSpeed(); }

    public function overcurrent()
    { return $this->get_overcurrent(); }

    public function setOvercurrent($newval)
    { return $this->set_overcurrent($newval); }

    public function tCurrStop()
    { return $this->get_tCurrStop(); }

    public function setTCurrStop($newval)
    { return $this->set_tCurrStop($newval); }

    public function tCurrRun()
    { return $this->get_tCurrRun(); }

    public function setTCurrRun($newval)
    { return $this->set_tCurrRun($newval); }

    public function alertMode()
    { return $this->get_alertMode(); }

    public function setAlertMode($newval)
    { return $this->set_alertMode($newval); }

    public function command()
    { return $this->get_command(); }

    public function setCommand($newval)
    { return $this->set_command($newval); }

    /**
     * Continues the enumeration of stepper motors started using yFirstStepperMotor().
     *
     * @return a pointer to a YStepperMotor object, corresponding to
     *         a stepper motor currently online, or a null pointer
     *         if there are no more stepper motors to enumerate.
     */
    public function nextStepperMotor()
    {   $resolve = YAPI::resolveFunction($this->_className, $this->_func);
        if($resolve->errorType != YAPI_SUCCESS) return null;
        $next_hwid = YAPI::getNextHardwareId($this->_className, $resolve->result);
        if($next_hwid == null) return null;
        return self::FindStepperMotor($next_hwid);
    }

    /**
     * Starts the enumeration of stepper motors currently accessible.
     * Use the method YStepperMotor.nextStepperMotor() to iterate on
     * next stepper motors.
     *
     * @return a pointer to a YStepperMotor object, corresponding to
     *         the first stepper motor currently online, or a null pointer
     *         if there are none.
     */
    public static function FirstStepperMotor()
    {   $next_hwid = YAPI::getFirstHardwareId('StepperMotor');
        if($next_hwid == null) return null;
        return self::FindStepperMotor($next_hwid);
    }

    //--- (end of YStepperMotor implementation)

};

//--- (StepperMotor functions)

/**
 * Retrieves a stepper motor for a given identifier.
 * The identifier can be specified using several formats:
 * <ul>
 * <li>FunctionLogicalName</li>
 * <li>ModuleSerialNumber.FunctionIdentifier</li>
 * <li>ModuleSerialNumber.FunctionLogicalName</li>
 * <li>ModuleLogicalName.FunctionIdentifier</li>
 * <li>ModuleLogicalName.FunctionLogicalName</li>
 * </ul>
 *
 * This function does not require that the stepper motor is online at the time
 * it is invoked. The returned object is nevertheless valid.
 * Use the method YStepperMotor.isOnline() to test if the stepper motor is
 * indeed online at a given time. In case of ambiguity when looking for
 * a stepper motor by logical name, no error is notified: the first instance
 * found is returned. The search is performed first by hardware name,
 * then by logical name.
 *
 * @param func : a string that uniquely characterizes the stepper motor
 *
 * @return a YStepperMotor object allowing you to drive the stepper motor.
 */
function yFindStepperMotor($func)
{
    return YStepperMotor::FindStepperMotor($func);
}

/**
 * Starts the enumeration of stepper motors currently accessible.
 * Use the method YStepperMotor.nextStepperMotor() to iterate on
 * next stepper motors.
 *
 * @return a pointer to a YStepperMotor object, corresponding to
 *         the first stepper motor currently online, or a null pointer
 *         if there are none.
 */
function yFirstStepperMotor()
{
    return YStepperMotor::FirstStepperMotor();
}

//--- (end of StepperMotor functions)
?>