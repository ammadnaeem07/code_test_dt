1. In Index method ADMIN_ROLE_ID, SUPERADMIN_ROLE_ID are defined in ENV where we add ENV file in .gitignore.
We have to update values every time when there is a new deployment somewhere or adding new Role.
If there is a case where we have to manage Roles by creating a CONSTANTS, I suggest to create Table for that. Otherwise we can use gates and policies of Laravel.

2. All return response($response); should be  return response()->json($response);

3. distanceFeed() method has alot of condition it can be reduce.