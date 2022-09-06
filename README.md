## explorer health-check util
This repository contains the alt-eth explorer health check util.
Compatible for Kekchain Explorer: https://github.com/lol-chain/explorer

## how to use it frens?
Clone the health-check util into a directory within the explorer path.
Assumes explorer has been built for production, directions may be passed on later;

Example:
1) Clone explorer (later recursively)  
  ```git clone https://github.com/lol-chain/explorer```

1b) Build explorer for production, with distillery. (more details for explorer installation at explorer repository)
release compile: ```mix distillery.release```

2) Change directory into explorer, and clone health-util
  ```cd explorer && git clone https://github.com/lol-chain/check-explorer-health-util health```
2b) Fix start/stop permissions (ensure executable)
  ```chmod ug+x exec_start.sh && chmod ug+x exec_stop.sh```
  
3) Change directory into health, and execute the strategy (90 second loop)
   ```sh run.sh```
   
## Success outputs: 

```
145785
145785
Proceeding comparison of block numbers...MATCH
145794
145794
Proceeding comparison of block numbers...MATCH
145803
145803
Proceeding comparison of block numbers...MATCH
```

## Error cases handled:
+ If RPC||EXP blockNumber type != integer; 
+ If RPC||EXP blockNumber not matching;
+ If EXP > RPC return success, and dissalow Explorer reboot;
+ write log files on success, or error;
+ more!

## Safety Solutions: 
+ ensure type safety && divert strategy if mismatch detected
+ ensure Explorer is not on alt-chain
+ ensure Explorer won't reboot if RPC is down or unreachable
+ ensure RPC is reachable
+ ensure Explorer is on main chain, not alt-chain forked
+ safe Explorer height > RPC height won't trigger reboot
+ retry comparison of block heights every 5 seconds in 4 statements
+ reiterate health strategy every 90 seconds

## Made with <3
Thank to our affiliates, and donors for sponsoring the future of cryptocurrency development!
Kekchain https://kekchain.com
Crystaleum https://crystaleum.org
Electronero Network https://electronero.org

Donations welcomed! Any alt-ethereum or EVM chain accepted. 
Devs wallet ```0xD87243a8629905813c28fB82136f99d6Ab29E46e```

## Contact 
To reach devs message us on Telegram.

Interchained: https://t.me/interchained
Bill Aure: https://t.me/billaure
