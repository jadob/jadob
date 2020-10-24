# BC Breaks for `0.1.1` version:

- `Jadob\Security\Supervisor\RequestSupervisor\RequestSupervisorInterface#handleAuthenticationFailure()` now returns `null|Response`:
````diff
-    public function handleAuthenticationFailure(AuthenticationException $exception, Request $request): Response;
+    public function handleAuthenticationFailure(AuthenticationException $exception, Request $request): ?Response;
````