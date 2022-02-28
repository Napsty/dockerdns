# dockerdns
DNS Checks inside a Docker container environment.

Starts an internal PHP server, listening on port 8053.
You can then run a HTTP request on the IP of the Docker Host, e.g. `http://ip.of.docker.node:8053/_health.php`.
The output of the plugin shows the response time of the DNS resolving.

```
{ "dockerdns": { "message":"DNS OK: 0.023 seconds response time. www.google.com returns 209.85.203.103,209.85.203.104,209.85.203.105,209.85.203.106,209.85.203.147,209.85.203.99,2a00:1450:400b:c01::63,2a00:1450:400b:c01::68,2a00:1450:400b:c01::69,2a00:1450:400b:c01::6a|time=0.023093s;;;0.000000", "exitcode":0, "responsetime":0.023093 }}
```

This Docker image Uses the monitoring plugin check_dns in the background.
