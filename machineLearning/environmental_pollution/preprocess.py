import torch.nn as nn
import torch


def data2matrix(df_raw):
    matrices = []
    columns_to_extract = ['NO2', 'PM10', 'CO', 'O3', 'SO2', 'temperature', 'humidity', 'wind_speed', 'precipitation']

    # Transferring into matrices
    for i in range(len(df_raw)):
        row = df_raw.iloc[i]
        row = row.to_dict()
        values = [row[key] for key in columns_to_extract]
        # print('Values', values)
        embedding_dim = 10
        embedding = nn.Embedding(num_embeddings=61, embedding_dim=embedding_dim)
        # print(embedding)
        values_tensor = torch.LongTensor(values)
        # print('Tensor', values_tensor)
        embedded = embedding(values_tensor)
        n = int(embedded.shape[0] ** 0.5)
        embedded_matrix = embedded.view(n, n, embedding_dim)
        matrices.append(embedded_matrix)
    return df_raw["PM2_5"].tolist(), matrices
