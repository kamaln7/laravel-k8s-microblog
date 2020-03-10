Create a production `.env.k8s` and store it as a secret: `kubectl create secret generic contacts-app --from-file=.env=.env.k8s`
