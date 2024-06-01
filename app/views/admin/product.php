<table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Mô tả </th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <tr th:each="item, itemStat : ${menu}">
                    <td th:text="${itemStat.count}"></td>
                    <td>
                        <img th:src="${item.url}" alt="Card image cap" style="height: 100px; object-fit: cover;">
                    </td>
                    <td>
                        <h5 th:text="${item.name}">Special title treatment</h5>
                    </td>
                    <td th:text="${item.price}"></td>
                    <td th:text="${item.description}"></td>
                    <td>
                        <p th:if="${item.statussell == 1}" class="text-success">Đang bán</p>
                        <p th:if="${item.statussell == 0}" class="text-danger">Dừng bán</p>
                    </td>
                    <td>
                        <div class="d-flex align-items-end justify-content-between">
                            <a class="p-2 m-1" href="#" th:href="@{/store/editfood/{id}(id=${item.id})}">
                                <i style="height: 70px; width: 70px;" class="ti ti-edit"></i>
                            </a>
                            <a th:if="${item.statussell == 1}" class="p-2 m-1" th:href="@{/store/foodstatus/{id}(id=${item.id})}">
                                <i style="height: 70px; width: 70px;" class="ti ti-eye-off"></i>
                            </a>
                            <a th:if="${item.statussell == 0}" class="p-2 m-1" th:href="@{/store/foodstatus/{id}(id=${item.id})}">
                                <i style="height: 70px; width: 70px;" class="ti ti-eye-check"></i>
                            </a>
                        </div>

                    </td>
                </tr>
            </tbody>
        </table>